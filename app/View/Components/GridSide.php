<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GridSide extends Component
{
    public string $title;
    public ?string $iconUrl;
    public ?string $extraImageUrl;
    public bool $searchField;
    public bool $addButton;
    public bool $deleteButton;
    public bool $filterButton;
    public bool $sortButton;
    public ?string $buttonResource;
    public ?string $pathResource;
    public ?string $apiResource;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $title,
        string $iconUrl = null,
        string $extraImageUrl = null,
        bool $searchField = false,
        bool $addButton = false,
        bool $deleteButton = false,
        bool $filterButton = false,
        bool $sortButton = false,
        string $buttonResource = null,
        string $pathResource = null,
        string $apiResource = null
    )
    {
        $this->title = $title;
        $this->iconUrl = $iconUrl;
        $this->extraImageUrl = $extraImageUrl;
        $this->searchField = $searchField;
        $this->addButton = $addButton;
        $this->deleteButton = $deleteButton;
        $this->filterButton = $filterButton;
        $this->sortButton = $sortButton;
        $this->buttonResource = $buttonResource;
        $this->pathResource = $pathResource;
        $this->apiResource = $apiResource;
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

    public function shouldShowButton(): bool
    {
        return $this->addButton || $this->deleteButton || $this->filterButton || $this->sortButton || $this->searchField;
    }

    private function getArgs(): array
    {
        return [
            'title' => $this->title,
            'iconUrl' => $this->iconUrl,
            'extraImageUrl' => $this->extraImageUrl,
            'searchField' => $this->searchField,
            'addButton' => $this->addButton,
            'deleteButton' => $this->deleteButton,
            'filterButton' => $this->filterButton,
            'sortButton' => $this->sortButton,
            'buttonResource' => $this->buttonResource,
            'pathResource' => $this->pathResource,
            'apiResource' => $this->apiResource
        ];
    }
}
