<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($data = null, $msg = 'success', $status = 200)
    {
        return response()->json(['status' => true, 'message' => $msg, 'data' => $data], $status);
    }

    public function responseFail($msg = 'fail', $status = 200)
    {
        return response()->json(['status' => false, 'message' => $msg], $status);
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
