<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGeneralValidation;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('access-' . $this->route);

        $data =  Cache::remember($this->route, now()->addMinutes(30), function ()  {
            return $this->model->get();
        });

        return view('admin.' . $this->view . '.index')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function create()
    {
        Gate::authorize('create-' . $this->route);

        $data = [];
        if (isset($this->model->create_data) && count($this->model->create_data) > 0) {
            foreach ($this->model->create_data as $name => $values) {
                if (isset($values['model'])) {
                    $object = "App\\Models\\{$values['model']}";
                    $model = new $object;
                    if (isset($values['condition'])) {
                        $model = $model->where($values['condition']);
                    }
                    $data[$name] = $model->get();
                }
            }
        }
        return view('admin.' . $this->view . '.create')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function store(AdminGeneralValidation $request)
    {
        Gate::authorize('create-' . $this->route);

        $data = $request->all();
        $data = $data + $this->translated_data($data);
        $item = $this->model->create($data);
        if ($request->image && $item) {
            $this->upload_image('profile', $item->id, $request->image);
        }
        return redirect()->route('admin.' . $this->route . '.index')
            ->with('success', 'successfully');
    }

    public function edit($id)
    {
        Gate::authorize('edit-' . $this->route);

        $data = $this->model->findOrFail($id);
        return view('admin.' . $this->view . '.edit')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function show($id)
    {
        Gate::authorize('show-' . $this->route);

        $data = $this->model->findOrFail($id);
        return view('admin.' . $this->view . '.show')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function destroy($id)
    {
        Gate::authorize('delete-' . $this->route);

        $data = $this->model->findOrFail($id);
        if ($data->delete()) {
            $files = File::where(['item_id' => $id, 'model' => $this->route])->get();
            if ($files) {
                $files->map->delete();
            }
        }
        return redirect()->route('admin.' . $this->route . '.index')
            ->with('success', 'successfully');
    }
}
