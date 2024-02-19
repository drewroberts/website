<?php

namespace Laravel\Nova\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\UpdateResourceRequest;
use Laravel\Nova\Nova;
use Throwable;

class ResourceUpdateController extends Controller
{
    /**
     * The action event for the action.
     *
     * @var ActionEvent
     */
    protected $actionEvent = null;

    /**
     * Create a new resource.
     *
     * @param  \Laravel\Nova\Http\Requests\UpdateResourceRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(UpdateResourceRequest $request)
    {
        $model = $request->findModelQuery()->lockForUpdate()->firstOrFail();

        try {
            [$model, $resource] = DB::connection($model->getConnectionName())->transaction(function () use ($request, $model) {
                $resource = $request->newResourceWith($model);
                $resource->authorizeToUpdate($request);
                $resource::validateForUpdate($request, $resource);

                if ($this->modelHasBeenUpdatedSinceRetrieval($request, $model)) {
                    return response('', 409)->throwResponse();
                }

                [$model, $callbacks] = $resource::fillForUpdate($request, $model);

                Nova::actionEvent()->forResourceUpdate($request->user(), $model)->save();

                $model->save();

                collect($callbacks)->each->__invoke();

                return [$model, $resource];
            });

            return response()->json([
                'id' => $model->getKey(),
                'resource' => $model->attributesToArray(),
                'redirect' => $resource::redirectAfterUpdate($request, $resource),
            ]);
        } catch (Throwable $e) {
            optional($this->actionEvent)->delete();
            throw $e;
        }
    }

    /**
     * Determine if the model has been updated since it was retrieved.
     *
     * @param  \Laravel\Nova\Http\Requests\UpdateResourceRequest  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return bool
     */
    protected function modelHasBeenUpdatedSinceRetrieval(UpdateResourceRequest $request, $model)
    {
        $resource = $request->newResource();

        // Check to see whether Traffic Cop is enabled for this resource...
        if ($resource::trafficCop($request) === false) {
            return false;
        }

        $column = $model->getUpdatedAtColumn();

        if (! $model->{$column}) {
            return false;
        }

        return $request->input('_retrieved_at') && $model->usesTimestamps() && $model->{$column}->gt(
            Carbon::createFromTimestamp($request->input('_retrieved_at'))
        );
    }
}
