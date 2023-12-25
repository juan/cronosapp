<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var int|mixed
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'role_id',
            'state_id',
            'identity_id',
            'gender_id',
            'usertype_type',
            'usertype_id',
            'name',
            'lastname',
            'email',
            'dni',
            'cuil',
            'address',
            'phone',
            'password',
            'email_verified_at',
            'datebirth',
            'profile_photo_path',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'datebirth' => 'date',
        ];

    /**All relations for User**/

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class)->orderBy('numcolum', 'asc');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return (bool) $role->intersect($this->roles)->count();
    }

    public function giveRoleUser(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function usertype()
    {
        return $this->morphTo();
    }

    public function isOwner()
    {
        $owner = $this->where('id', @auth()->id())
            ->withCount([
                'roles' => function ($query) {
                    $query->select('id')->where('id', 1);
                },
            ])
            ->first();

        return $owner->roles_count;
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function lastname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->lower($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->squish($value),
        );
    }
}
