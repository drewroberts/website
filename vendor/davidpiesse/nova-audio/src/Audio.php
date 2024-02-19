<?php

namespace Davidpiesse\Audio;

use Laravel\Nova\Fields\File;
use Illuminate\Support\Facades\Storage;

class Audio extends File
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'audio';

    public $textAlign = 'center';

    public $showOnIndex = true;

    public function preview(callable $previewUrlCallback)
    {
        $this->previewUrlCallback = function(){
            return $this->value
                ? Storage::disk($this->disk)->url($this->value)
                : null;
        };

        return $this;
    }
}
