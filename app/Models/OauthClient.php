<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OauthClient.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $secret
 * @property string|null $provider
 * @property string $redirect
 * @property int $personal_access_client
 * @property int $password_client
 * @property int $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient query()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient wherePasswordClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient wherePersonalAccessClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthClient whereUserId($value)
 * @mixin \Eloquent
 */
class OauthClient extends Model
{
}
