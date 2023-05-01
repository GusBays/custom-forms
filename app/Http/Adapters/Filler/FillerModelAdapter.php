<?php

namespace App\Http\Adapters\Filler;

use App\Datas\Filler\FillerUpdateData;
use App\Models\Filler;

class FillerModelAdapter extends FillerUpdateData
{
    public function __construct(
        Filler $filler
    )
    {
        parent::__construct(
            $filler->id,
            $filler->getAttribute('organization_id') ?? $filler->getAttribute('fillers.organization_id'),
            $filler->name,
            $filler->first_name,
            $filler->last_name,
            $filler->email,
            $filler->created_at,
            $filler->updated_at
        );
    }

    public static function collection(array $fillers): array
    {
        return collect($fillers)->mapInto(self::class)->all();
    }
}