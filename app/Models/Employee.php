<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lastname',
        'name',
        'patronymic',
    ];

    /**
     * Полное имя сотрудника
     * 
     * @return string
     */
    public function getFullnameAttribute()
    {
        return collect([$this->lastname, $this->name, $this->patronymic])->filter()->join(" ");
    }
}
