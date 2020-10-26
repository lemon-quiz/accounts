<?php

namespace App\Http\Controllers\Api;

use App\Events\User\UserCreate;
use App\Events\User\UserDelete;
use App\Events\User\UserUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Http\Requests\Api\User\UserDeleteRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsController extends Controller
{

    public function index(Request $request)
    {
        return User::paginatedResources($request, function () {
        });
    }

    public function view(Request $request, $id)
    {
        return User::viewResource($id, $request);
    }

    public function create(UserCreateRequest $request)
    {
        UserCreate::handleEvent(null, $request->all());
    }

    public function update(UserUpdateRequest $request, $id)
    {
        UserUpdate::handleEvent($id, $request->all());
    }

    public function delete(UserDeleteRequest $request, $id)
    {
        UserDelete::handleEvent($id, $request->all());
    }

}
