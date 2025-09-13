<?php

namespace Modules\Employee\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation',
        'monthly_salary_package',
        'monthly_tax_value',
        'yearly_increasing_bonus',
        'monthly_net_salary',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'monthly_salary_package' => 'float',
        'monthly_tax_value' => 'float',
        'yearly_increasing_bonus' => 'float',
        'monthly_net_salary' => 'float',
    ];
}
