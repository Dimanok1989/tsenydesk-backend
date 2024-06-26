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
            'date_sale' => 'datetime',
            'date_sale_term' => 'datetime',
            'date_sent_documents' => 'datetime',
            'date_sent_documents_actual' => 'datetime',
            'date_inspection' => 'datetime',
            'date_inspection_actual' => 'datetime',
            'date_remeasurement' => 'datetime',
            'date_remeasurement_actual' => 'datetime',
            'date_start' => 'datetime',
            'date_start_actual' => 'datetime',
            'inspection_types' => "array",
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
