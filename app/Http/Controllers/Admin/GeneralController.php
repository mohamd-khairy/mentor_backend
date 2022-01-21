<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGeneralValidation;
use App\Models\File;
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
        $data = $this->model;
        if (isset($this->model->selected) && !empty($this->model->selected)) {
            $data = $data->select($this->model->selected);
        }
        $data = $data->get();
        return view('admin.' . $this->view . '.index')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function create()
    {
        $data = [];
        if (isset($this->model->create_data)) {
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
        $data = $request->all();
        $data = $data + $this->translated_data($data);
        $item = $this->model->create($data);
        if ($request->image && $item) {
            $this->upload_image('profile', $item->id, $request->image);
        }
        return redirect()->route('admin.' . $this->route . '.index')
            ->with('success', 'successfully');
    }

    public function destroy($id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();
        $this->delete_image($id, $this->route);
        return redirect()->route('admin.' . $this->route . '.index')
            ->with('success', 'successfully');
    }

    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        return view('admin.' . $this->view . '.show')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function edit($id)
    {
        $data = $this->model->findOrFail($id);
        return view('admin.' . $this->view . '.edit')
            ->with([
                'data' => $data,
                'request_data' => $this->request_data
            ]);
    }

    public function upload_image($type = null, $item_id = null, $image = null)
    {
        try {
            if ($image && $type && $item_id) {
                if (is_array($image)) {
                    foreach ($image as $img) {
                        $image_name = time() . rand(1, 100000) . '.' . $img->getClientOriginalExtension();
                        $img->move(public_path('images/' . $type ?? 'all'), $image_name);
                        $name = 'images/' . $type . '/' . $image_name;
                        File::firstOrCreate(['item_id' => $item_id, 'type' => $type, 'name' => $name, 'model' => $this->route]);
                    }
                } else {
                    $image_name = time() . rand(1, 100000) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/' . $type), $image_name);
                    $name = 'images/' . $type . '/' . $image_name;
                    $file = File::firstOrCreate(['item_id' => $item_id, 'type' => $type, 'name' => $name, 'model' => $this->route]);
                    return $file->name;
                }
            }
            return null;
            //code...
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function delete_image($id = null, $model)
    {
        try {
            $files = File::where(['item_id' => $id, 'model' => $model])->get();
            foreach ($files as  $value) {
                if (file_exists(public_path($value->name))) {
                    unlink(public_path($value->name));
                }
            }
            $files = File::where(['item_id' => $id, 'model' => $model])->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function translated_data($data)
    {
        try {
            if (isset($this->model->translatable)) {
                foreach ($this->model->translatable as $value) {
                    $en = isset($data[$value . '_en']) ? $data[$value . '_en'] : null;
                    $ar = isset($data[$value . '_ar']) ? $data[$value . '_ar'] : null;
                    $data[$value] = ['en' => $en, 'ar' => $ar];
                }
                return $data;
            }
            return [];
        } catch (\Throwable $th) {
            return [];
        }
    }
}
