<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory, RecordsActivity;

    protected $fillable
        = [
            'city_id', 'state_id', 'company_name',
            'company_cuit', 'company_address', 'company_zipcode',
            'company_phone', 'company_email', 'company_web',
            'company_person_contact', 'company_person_phone',
            'company_person_email',
        ];

    /**Model Relatiosn**/

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /** End Model Relatiosn**/
    public function nameatribute()
    {
        return $this->company_name;
    }

    public function scopeData($query)
    {
        return $query->first()->with('city.province')->first();
    }

    protected function companyName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyCuit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyAddress(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyZipcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyEmail(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }

    protected function companyWeb(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }

    protected function companyPersonContact(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyPersonPhone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function companyPersonEmail(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }
}
