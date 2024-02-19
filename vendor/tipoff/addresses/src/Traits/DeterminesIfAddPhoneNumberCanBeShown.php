<?php namespace Tipoff\Addresses\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait DeterminesIfAddPhoneNumberCanBeShown
{
    /**
     * The callback used to determine if the create relation button should be shown.
     *
     * @var bool|\Closure
     */
    public $showAddPhoneNumberButtonCallback;

    /**
     * @param \Closure|bool $callback
     * @return $this
     */
    public function showAddPhoneNumberButton($callback = true)
    {
        $this->showAddPhoneNumberButtonCallback = $callback;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideAddPhoneNumberButton()
    {
        $this->showAddPhoneNumberButtonCallback = false;

        return $this;
    }

    /**
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return bool
     */
    public function addPhoneNumberShouldBeShown(NovaRequest $request)
    {
        return with($this->showAddPhoneNumberButtonCallback, function ($callback) use ($request) {
            if ($callback === true || (is_callable($callback) && call_user_func($callback, $request))) {
                return true;
            }

            return false;
        });
    }
}
