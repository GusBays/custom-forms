<?php

namespace App\Repositories;

use App\Datas\Filler\FillerData;
use App\Datas\Filler\FillerUpdateData;
use App\Filters\Filler\FillerFilter;
use App\Filters\Filler\FillerGetAllFilter;
use App\Filters\Filler\FillerIdFilter;
use App\Http\Adapters\Filler\FillerModelAdapter;
use App\Interpreters\Filler\FillerEmailInterpreter;
use App\Interpreters\Filler\FillerIdInterpreter;
use App\Interpreters\FilterInterpreter;
use App\Interpreters\SearchInterpreter;
use App\Interpreters\SortInterpreter;
use App\Models\Filler;
use App\Traits\PerPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FillerRepository
{
    use PerPage;

    protected Filler $model;

    public function __construct(
        Filler $model
    )
    {
        $this->model = $model;
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
        $fillers = $this->getFillerQuery(new FillerGetAllFilter())
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
        $filler = $this->getFillerQuery(new FillerIdFilter($data->getId()))->firstOrFail();
        
        $filler->fill($data->onlyModifiedData())->save();

        return new FillerModelAdapter($filler);
    }

    public function delete(FillerFilter $filter): void
    {
        $filler = $this->getFillerQuery($filter)->firstOrFail();

        $filler->delete();
    }

    public function getNotifiableInstance(FillerFilter $filter): Filler
    {
        return $this->getFillerQuery($filter)->firstOrFail();
    }

    protected function getFillerQuery(FillerFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FillerIdInterpreter($filter),
            new FillerEmailInterpreter($filter),
            new FilterInterpreter(),
            new SearchInterpreter(),
            new SortInterpreter()
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}