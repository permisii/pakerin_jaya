<?php

namespace App\Traits\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable {
    public function applyColumnFilters(Builder $query, Request $request, array $filterableColumns): Builder {
        $searchParams = $request->query();

        if (isset($searchParams['column_filters'])) {
            foreach ($searchParams['column_filters'] as $key => $value) {
                if (!in_array($key, $filterableColumns)) {
                    continue;
                }
                $query->where($key, $value);
            }
        }

        return $query;
    }
}
