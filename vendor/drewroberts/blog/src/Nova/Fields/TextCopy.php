<?php
/**
 * Original TextCopy by TJ Miller
 *
 * Modified by Tipoff
 *
 * https://github.com/sixlive/nova-text-copy-field
 */
namespace DrewRoberts\Blog\Nova\Fields;

use Closure;
use Laravel\Nova\Fields\Field;

class TextCopy extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'text-copy';

    public $meta = [
        'show_button_on_hover' => false,
    ];

    /**
     * Truncate the fields displayed value.
     *
     * @param  int $length
     * @return TextCopy
     */
    public function truncate($length = 0)
    {
        $this->withMeta(['truncate' => $length]);

        return $this;
    }

    /**
     * Apply a mask to the display.
     *
     * @param  string $mask
     * @return TextCopy
     */
    public function mask($character = '*')
    {
        $this->withMeta([
            'masked' => true,
            'masked_character' => $character,
        ]);

        return $this;
    }

    /**
     * Set the copy button's title attribute.
     *
     * @param  string  $title
     * @return TextCopy
     */
    public function copyButtonTitle($title = '')
    {
        $this->withMeta([
            'copy_button_title' => $title,
        ]);

        return $this;
    }

    /**
     * Mutate the value that will be copied.
     *
     * @param  string|int|Closure $value
     * @return TextCopy
     */
    public function copyValue($value)
    {
        $this->withMeta([
            'copy_value' => $value instanceof Closure
                ? $value($this->value)
                : $value,
        ]);

        return $this;
    }

    /**
     * Hide the copy button until a user hovers over the field value.
     *
     * @return TextCopy
     */
    public function showButtonOnlyOnHover()
    {
        $this->withMeta([
            'show_button_on_hover' => true,
        ]);

        return $this;
    }

    /**
     * Display the field as raw HTML using Vue.
     *
     * @return $this
     */
    public function asHtml()
    {
        return $this->withMeta(['asHtml' => true]);
    }
}
