<?php

namespace App\Repositories;

use App\Datas\Filler\FillerData;
use App\Datas\Filler\FillerUpdateData;
use App\Filters\Filler\FillerFilter;
use App\Http\Adapters\Filler\FillerModelAdapter;
use App\Interpreters\Filler\FillerIdInterpreter;
use App\Models\Filler;
use App\Traits\Filterable;
use App\Traits\PerPage;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FillerRepository
{
    use Filterable;
    use Searchable;
    use Sortable;
    use PerPage;

    protected Filler $model;
    protected Builder $query;

    public function __construct(
        Filler $model
    )
    {
        $this->model = $model;
        $this->query = $model->query();
    }

    public function create(FillerData $data): FillerUpdateData
    {
        $this->model->fill($data->toArray())->save();

        return new FillerModelAdapter($this->model);
    }

    /**
     * @return FillerUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        $fillers = $this->filter()
            ->search()
            ->sort()
            ->query
            ->paginate($this->perPage())
            ->items();

        return FillerModelAdapter::collection($fillers);
    }

    public function getOne(FillerFilter $filter): FillerUpdateData
    {
        $filler = $this->getFillerQuery($filter)->firstOrFail();

        return new FillerModelAdapter($filler);
    }

    public function update(FillerUpdateData $data): FillerUpdateData
    {
        $filler = $this->query->findOrFail($data->getId());
        
        $filler->fill($data->onlyModifiedData())->save();

        return new FillerModelAdapter($filler);
    }

    public function delete(FillerFilter $filter): void
    {
        $filler = $this->getFillerQuery($filter)->firstOrFail();

        $filler->delete();
    }

    protected function getFillerQuery(FillerFilter $filter): Builder
    {
        $interpreters = [
            new FillerIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}