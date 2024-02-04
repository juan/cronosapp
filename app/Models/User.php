<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Carbon\Carbon;
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
    use HasApiTokens, HasFactory, Notifiable, RecordsActivity, TableSorting;

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

    protected string $columSortName = 'dni';

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

    public static function arraycolumSor(): array
    {
        return [
            'dni' => 'DNI',
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'phone' => 'Teléfono',
        ];
    }

    public static function getModelAttributes(): array
    {
        return self::getModel()->getFillable();
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**All relations for User**/

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

    public function scopeTableQuery($query)
    {
        $query->where('id', '>', 1)->orderBy('name')
            ->orderBy('state_id', 'asc');
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

    public function scopeUserbyRole($query, $roleid = null, $string = null)
    {
        return $query
            ->where('role_id', $roleid)
            ->where('name', 'like',
                '%'.str()->upper($string).'%')
            ->doesntHave('doctor');
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

    protected function datebirth(): Attribute
    {

        return Attribute::make(
            get: fn ($value) => is_null($value) ? ''
                : date('d/m/Y', strtotime($value)),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y', $value)
                ->format('Y-m-d'),
        );
    }
}
