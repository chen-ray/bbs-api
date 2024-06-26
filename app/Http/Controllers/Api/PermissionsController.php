<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $permissions = $request->user()->getAllPermissions();
        PermissionResource::wrap('data');
        return PermissionResource::collection($permissions);
    }
}
