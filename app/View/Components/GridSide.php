<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GridSide extends Component
{
    public string $title;
    public ?string $iconUrl;
    public ?string $extraImageUrl;
    public bool $showButtons;
    public ?string $resource;
    public ?string $registro;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $title,
        string $iconUrl = null,
        string $extraImageUrl = null,
        bool $showButtons = false,
        string $resource = null,
        string $registro = null
    )
    {
        $this->title = $title;
        $this->iconUrl = $iconUrl;
        $this->extraImageUrl = $extraImageUrl;
        $this->showButtons = $showButtons;
        $this->resource = $resource;
        $this->registro = $registro;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.grid-side', $this->getArgs());
    }

    private function getArgs(): array
    {
        return [
            'title' => $this->title,
            'iconUrl' => $this->iconUrl,
            'extraImageUrl' => $this->extraImageUrl,
            'resource' => $this->resource,
            'registro' => $this->registro
        ];
    }
}
