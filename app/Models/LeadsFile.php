<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class LeadsFile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lead_id',
        'name',
        'filename',
        'path',
        'extension',
        'mime_type',
        'disk',
        'group',
        'size',
    ];

    public function getFullPathAttribute()
    {
        return $this->path . "/" . $this->filename . ($this->extension ? "." . $this->extension : "");
    }

    public function getUrlAttribute()
    {
        return route('api.leads.file', [
            'file' => $this->full_path,
        ]);
    }

    public function getIsImageAttribute()
    {
        return exif_imagetype(Storage::disk($this->disk)->path($this->full_path)) !== false;
    }
}
