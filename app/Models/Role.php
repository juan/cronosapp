<?php

namespace App\Models;

use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, TableSorting;

    protected $fillable = ['name_role', 'state_id'];

    protected string $columSortName = 'name_role';

    public function giveActionsTo(Action $action)
    {
        return $this->actions()->save($action);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }

    public function countCreate()
    {

        return $this->actions()->count();
    }

    public function scopeListRoles(
        $query,
        array $arrayroles = null
    ) {
        $ownerarray[] = null;

        if (@auth()->user()->isOwner()) {
            $isowner = 1;
            $ownerarray[] = 1;
        } else {
            $isowner = 2;
        }

        return $query->where(function ($query) use (
            $arrayroles,
            $isowner,
            $ownerarray
        ) {
            if (is_null($arrayroles)) {
                $query->where('id', '>=', $isowner)->where('state_id', 1);
            } else {
                $query->whereIn('id', array_merge($arrayroles, $ownerarray))
                    ->where('state_id', 1);
            }
        })->orderBy('name_role');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function scopeTableQuery($query)
    {
        if (@auth()->user()->isOwner()) {
            $isowner = 1;
        } else {
            $isowner = 2;
        }

        return $query->where('id', '>=', $isowner)
            ->with(['state']);
    }

    /**Accessors & Mutators Attributes**/
    protected function nameRole(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
