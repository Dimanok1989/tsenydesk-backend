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
        'date_sent_documents',
        'date_inspection',
        'date_remeasurement',
        'date_start',
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
            'date_sent_documents' => 'datetime:Y-m-d',
            'date_inspection' => 'datetime:Y-m-d',
            'date_remeasurement' => 'datetime:Y-m-d',
            'date_start' => 'datetime:Y-m-d',
        ];
    }
}
