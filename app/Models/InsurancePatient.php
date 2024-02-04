<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class InsurancePatient extends Model
{
    use RecordsActivity;

    protected $fillable
        = [
            'patient_id',
            'numafiliado',
            'insurance_id',
            'insurance_plan_id',
        ];

    public static function getModelAttributes(): array
    {
        return self::getModel()->getFillable();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function insurance()
    {

        return $this->belongsTo(Insurance::class, 'insurance_id')
            ->with(['insurance_type:id,name_type']);

    }

    public function plan()
    {
        return $this->belongsTo(InsurancePlan::class, 'insurance_plan_id');
    }

    protected function insurancePlanId(): Attribute
    {

        return Attribute::make(
            set: fn ($value) => empty($value) ? null : $value,
        );
    }
}
