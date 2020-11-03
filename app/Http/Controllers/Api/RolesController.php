<?php

namespace App\Http\Controllers\Api;

use App\Events\Role\RoleCreate;
use App\Events\Role\RoleDelete;
use App\Events\Role\RoleUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Role\RoleCreateRequest;
use App\Http\Requests\Api\Role\RoleDeleteRequest;
use App\Http\Requests\Api\Role\RoleUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelCode\EventSourcing\Models\Command;
use LaravelCode\EventSourcing\Models\Event;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        return Role::paginatedResources($request, function () {
        });
    }

    public function show(Request $request, $id)
    {
        return Role::resource($id, $request);
    }

    public function store(RoleCreateRequest $request)
    {
        return RoleCreate::handleEvent(null, $request->all());
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        return RoleUpdate::handleEvent($id, $request->all());
    }

    public function destroy(RoleDeleteRequest $request, $id)
    {
        return RoleDelete::handleEvent($id, $request->all());
    }

    public function events(Request $request, $id)
    {
        return Event::paginatedResources($request, function (Builder $query) use ($id) {
            $query->where('resource_id', $id)
                ->where('model', Role::class);
        });
    }
}
