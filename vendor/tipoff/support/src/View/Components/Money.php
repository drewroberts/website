<?php

declare(strict_types=1);

namespace Tipoff\Support\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Money extends Component
{
    public int $amount;
    public ?string $label;
    public string $formattedAmount;

    public function __construct($amount = null, $label = null)
    {
        $this->label = $label;
        $this->amount = (int) ($amount ?? 0);
        $this->formattedAmount = '$' . number_format($this->amount / 100, 2);
    }

    public function render()
    {
        /** @var View $view */
        $view = view('support::components.money');

        return $view;
    }
}
