<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lookup;
use App\Models\LookupType;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;

class CustomController extends Controller
{
    public function store_role_permission(Request $request)
    {
        Gate::authorize('create-role_permission');

        $data = $request->all();
        if ($request->permission_id) {
            RolePermission::where(['role_id' => $request->role_id])->delete();
            $permissions = Lookup::whereIn('id', $request->permission_id)->where('lookup_type_id', LookupType::Permission)->get();
            RolePermission::insert($permissions->map(fn ($q) => ['role_id' => $request->role_id, 'permission_id' => $q->id, 'key' => $q->key])->toArray());
        }

        Artisan::call('cache:clear');

        return redirect()->route('admin.role_permission.index')->with('success', 'successfully');
    }
}
