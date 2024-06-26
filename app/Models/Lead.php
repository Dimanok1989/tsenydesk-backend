<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'number',
        'date_sale',
        'date_sale_term',
        'date_sent_documents',
        'date_sent_documents_actual',
        'date_inspection',
        'date_inspection_actual',
        'date_remeasurement',
        'date_remeasurement_actual',
        'date_start',
        'date_start_actual',
        'inspection_types',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_sale' => 'datetime:Y-m-d',
            'date_sale_term' => 'datetime:Y-m-d',
            'date_sent_documents' => 'datetime:Y-m-d',
            'date_sent_documents_actual' => 'datetime:Y-m-d',
            'date_inspection' => 'datetime:Y-m-d',
            'date_inspection_actual' => 'datetime:Y-m-d',
            'date_remeasurement' => 'datetime:Y-m-d',
            'date_remeasurement_actual' => 'datetime:Y-m-d',
            'date_start' => 'datetime:Y-m-d',
            'date_start_actual' => 'datetime:Y-m-d',
            'inspection_types' => "array",
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
