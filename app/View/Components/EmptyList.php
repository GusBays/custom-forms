<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmptyList extends Component
{
    public ?string $resource;
    public ?string $pathResource;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $resource = null,
        string $pathResource = null
    )
    {
        $this->resource = $resource;
        $this->pathResource = $pathResource;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.empty-list', $this->getArgs());
    }

    private function getArgs(): array
    {
        return [
            'resource' => $this->resource,
            'pathResource' => $this->pathResource
        ];
    }
}
