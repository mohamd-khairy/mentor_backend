<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    public $title;
    public $class;
    public $model;
    public $route;
    public $view;
    public $validation;
    public $request_data = [];

    public function __construct()
    {
        $this->route = FacadesRequest::segment(1);
        $this->title = str_replace('_', ' ', Str::title($this->route));
        $this->class = str_replace('_', '', Str::title($this->route));
        $object = "App\\Models\\$this->class";
        $this->model = new $object;
        $this->view = 'general_crud';
        $this->request_data = [
            'route' => $this->route,
            'model' => $this->model,
            'view' => $this->view,
            'class' => $this->class,
            'title' => $this->title,
        ];
    }

    public function index()
    {
        $data = $this->model->select($this->model->visible)->get();
        // dd($data->toArray());
        return view('admin.' . $this->view . '.index')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }
}
