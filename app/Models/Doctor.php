<?php

namespace App\Models;

use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use TableSorting;

    protected $fillable
        = [
            'skill_id',
            'specialtie_id',
            'type_id',
            'state_id',
            'num_matricula',
            'interno_doc',

        ];

    protected string $columSortName = 'name_doc';

    protected $casts = ['interno_doc' => 'boolean'];

    public static function arraycolumSor()
    {
        return [
            'name_doc' => 'Nombre',
            'lastname_doc' => 'Apellido',
            'skill_id' => 'Mención',
            'specialtie_id' => 'Especialidad',
        ];
    }

    public function user()
    {
        return $this->morphOne(User::class, 'usertype');
    }

    public function scopeDoctorInfo($query, $idDoctor)
    {
        return $query->find($idDoctor);
    }

    public function specialtie(): BelongsTo
    {
        return $this->belongsTo(Specialtie::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function scopeSearchTerm(
        $query,
        string $serchterm = null,
        string $columname = null
    ) {
        if ($columname == 'skill_id') {

            return $query->orWhereHas('skill',
                function ($query) use ($serchterm) {
                    $query->where('name_skill', 'like',
                        '%'.str()->ucfirst(str()->lower($serchterm)).'%');
                });
        }

        if ($columname == 'specialtie_id') {
            return $query->orWhereHas('specialtie',
                function ($query) use ($serchterm) {
                    $query->where('name_speciality', 'like',
                        '%'.str()->upper($serchterm).'%');
                });
        }

        return $query;
    }
}
