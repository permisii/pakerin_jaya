<?php

namespace App\Traits\Controllers;

use Illuminate\Http\Request;

trait Searchable {
    public function search(Request $request, $model, $columns = ['name']) {
        return $model::where(function ($query) use ($request, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$request->get('q')}%");
            }
        })->limit(5)->get();
    }
}
