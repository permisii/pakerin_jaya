<?php

namespace App\Traits\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Searchable {
    public function search(Request $request, $model, $columns = ['name']): Builder {
        $query = $model::query();
        if ($request->get('search')) {
            $query->where(function ($query) use ($request, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $request->get('search') . '%');
                }
            });
        }

        return $query;
    }
}
