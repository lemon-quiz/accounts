<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelCode\EventSourcing\Models\SearchBehaviourTrait;

/**
 * App\Models\Role.
 *
 * @property int $id
 * @property string $name
 * @property int $private
 * @property int $init_employee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role paginatedResources(\Illuminate\Http\Request $request, $withQuery)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role resource($modelId, \Illuminate\Http\Request $request, $withQuery = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Role viewResource($modelId, \Illuminate\Http\Request $request, $withQuery = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereInitEmployee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $revision_number
 * @property string $grouped
 * @method static Builder|Role whereGrouped($value)
 * @method static Builder|Role whereRevisionNumber($value)
 */
class Role extends Model
{
    use HasFactory, SearchBehaviourTrait;

    protected $orderFields = [
        'name',
        'grouped',
        'id',
        'private',
        'init_employee',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'private' => 'boolean',
        'init_employee' => 'boolean',
    ];

    public function search()
    {
        return [
            'id',
            'name' => function (Builder $query, $value) {
                return $query->where('name', 'like', '%'.$value.'%');
            },
            'grouped' => function (Builder $query, $value) {
                return $query->where('grouped', 'like', '%'.$value.'%');
            },
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
