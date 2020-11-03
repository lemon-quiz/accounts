<?php

namespace App\Http\Controllers\Api;

use App\Events\User\UserCreate;
use App\Events\User\UserDelete;
use App\Events\User\UserRole;
use App\Events\User\UserUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Http\Requests\Api\User\UserDeleteRequest;
use App\Http\Requests\Api\User\UserRoleRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelCode\EventSourcing\Models\Command;
use LaravelCode\EventSourcing\Models\Event;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        return User::paginatedResources($request, function () {
        });
    }

    public function view(Request $request, $id)
    {
        return User::resource($id, $request);
    }

    public function create(UserCreateRequest $request)
    {
        return UserCreate::handleEvent(null, $request->all());
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return UserUpdate::handleEvent($id, $request->all());
    }

    public function delete(UserDeleteRequest $request, $id)
    {
        return UserDelete::handleEvent($id, $request->all());
    }

    public function role(UserRoleRequest $request, $id)
    {
        return UserRole::handleEvent($id, $request->all());
    }

    public function events(Request $request, $id)
    {
        return Event::paginatedResources($request, function (Builder $query) use ($id) {
            $query->where('id', $id)
                ->where('model', User::class);
        });
    }
}
