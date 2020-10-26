<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\RoleUser
 *
 * @property int $user_id
 * @property int $role_id
 * @property bool $req_get
 * @property bool $req_post
 * @property bool $req_put
 * @property bool $req_patch
 * @property bool $req_delete
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereReqDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereReqGet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereReqPatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereReqPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereReqPut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoleUser extends Pivot
{
    protected $casts = [
        'req_get' => 'boolean',
        'req_post' => 'boolean',
        'req_put' => 'boolean',
        'req_patch' => 'boolean',
        'req_delete' => 'boolean',
    ];
}
