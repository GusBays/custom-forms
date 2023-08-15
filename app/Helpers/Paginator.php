<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginator
{
    public static function paginate(array $items): LengthAwarePaginator
    {
        $perPage = request()->query('limit', 15);
        $currentPage = request()->query('page', 1);

        $begin = ($currentPage - 1) * $perPage;

        $collection = collect($items)->slice($begin, $perPage);

        return new LengthAwarePaginator(
            items: $collection,
            total: $collection->count(),
            currentPage: $currentPage,
            perPage: $perPage,
            options: [
                'path' => request()->url(),
                'query' => [
                    'page' => $currentPage
                ]
            ]
        );
    }
}