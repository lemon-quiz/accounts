<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelCode\EventSourcing\Models\Event;

class EventsController extends Controller
{
    public function index(Request $request) {
        return Event::paginatedResources($request, function(Builder $query) {
           // This should check the AuthorID
        });
    }
}
