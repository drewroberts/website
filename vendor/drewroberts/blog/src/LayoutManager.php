<?php

declare(strict_types=1);

namespace DrewRoberts\Blog;

use DrewRoberts\Blog\Models\Layout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class LayoutManager
{
    private ?Layout $layout = null;

    public function setLayout(?Layout $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function getLayout(): ?Layout
    {
        return $this->layout;
    }

    public function getViewName(string $default): string
    {
        if ($this->layout) {
            if (View::exists($this->layout->view)) {
                return $this->layout->view;
            }

            // Complain about missing view, but keep going
            Log::error('Layout view does not exist: '.$this->layout->view);
        }

        return $default;
    }
}
