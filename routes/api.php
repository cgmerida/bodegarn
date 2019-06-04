<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users', function () {
    return datatables(App\User::latest('updated_at')->get())
        ->addColumn('actions', 'users.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('roles', function () {
    return datatables(Caffeinated\Shinobi\Models\Role::all())
        ->addColumn('actions', 'roles.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('projects', function () {
    return datatables(App\Project::all())
        ->addColumn('actions', 'projects.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('materials', function () {
    return datatables(App\Material::all())
        ->addColumn('actions', 'materials.partials.actions')
        ->setRowClass(function ($material) {
            return $material->stock <= $material->min ? 'alert-danger' : 
            ($material->stock > $material->min && $material->stock <= ( $material->min + round($material->min / 2)) ?
            'alert-warning' : '');
        })
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('materials/api', function () {
    return App\Material::select('id', 'name')->get();
});
