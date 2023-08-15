<?php

namespace App\Http\Adapters\Filler;

use App\Datas\Filler\FillerUpdateData;
use App\Models\Filler;
use Illuminate\Database\Eloquent\Collection;

class FillerModelAdapter extends FillerUpdateData
{
    public function __construct(
        Filler $filler
    )
    {
        parent::__construct(
            id: $filler->id,
            organizationId: $filler->getAttribute('organization_id') ?? $filler->getAttribute('fillers.organization_id'),
            name: $filler->name,
            firstName: $filler->first_name,
            lastName: $filler->last_name,
            email: $filler->email,
            createdAt: $filler->created_at,
            updatedAt: $filler->updated_at
        );
    }

    public static function collection(Collection | array $fillers): array
    {
        return collect($fillers)->mapInto(self::class)->all();
    }
}