<?php

namespace App\Models;

use App\Events\Patient\NewEmailPatient;
use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use RecordsActivity, TableSorting;

    protected $fillable
        = [
            'identity_id',
            'gender_id',
            'name_patient',
            'lastname_patient',
            'numberid_patient',
            'datebirth',
            'cellphone',
            'email_patient',
            'direccion_patient',
            'cuil_patient',
        ];

    protected string $columSortName = 'numberid_patient';

    protected $casts
        = [
            'datebirth' => 'date',
        ];

    public static function arraycolumSor()
    {
        return [
            'numberid_patient' => 'DNI',
            'name_patient' => 'Nombre',
            'lastname_patient' => 'Apellido',
        ];
    }

    protected static function booted()
    {
        static::created(function ($patient) {
            if (! empty($patient->email_patient)) {
                event(new NewEmailPatient($patient));
            }
        });
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function identity(): BelongsTo
    {
        return $this->belongsTo(Identity::class);
    }

    public function scopeTableQuery($query)
    {
        return $query->orderBy('name_patient')
            ->orderBy('lastname_patient');
    }

    public function insurance_patient()
    {
        return $this->hasMany(InsurancePatient::class);
    }

    protected function genderId(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => empty($value) ? 1 : $value,
        );
    }

    protected function namePatient(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function lastnamePatient(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function datebirth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? ''
                : date('d-m-Y', strtotime($value)),
            set: fn ($value) => str()->squish($value),
        );
    }

    protected function numberidPatient(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->squish($value),
        );
    }

    protected function cellphone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->squish($value),
        );
    }

    protected function direccionPatient(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->squish($value),
        );
    }

    protected function emailPatient(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->lower($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }
}
