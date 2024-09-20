<?php

namespace App\Http\Controllers;

abstract class Controller {
    protected $breadcrumbs = [];
    protected $params = [];

    protected function setBreadcrumbs(array $breadcrumbs) {
        $this->breadcrumbs = $breadcrumbs;
    }

    protected function getBreadcrumbs() {
        return $this->breadcrumbs;
    }

    protected function setParams(array $params) {
        $this->params = $params;
    }

    protected function getParams() {
        return $this->params;
    }

    protected function renderView($view, $data = []) {
        return view($view, array_merge($data, ['breadcrumbs' => $this->getBreadcrumbs(), 'params' => $this->getParams()]));
    }
}
