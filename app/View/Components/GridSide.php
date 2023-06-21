<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GridSide extends Component
{
    public string $title;
    public ?string $iconUrl;
    public ?string $extraImageUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $title,
        string $iconUrl = null,
        string $extraImageUrl = null
    )
    {
        $this->title = $title;
        $this->iconUrl = $iconUrl;
        $this->extraImageUrl = $extraImageUrl;
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
            'hasIcon' => filled($this->iconUrl),
            'iconUrl' => $this->iconUrl,
            'hasExtraImage' => filled($this->extraImageUrl),
            'extraImageUrl' => $this->extraImageUrl
        ];
    }
}
