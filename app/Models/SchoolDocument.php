<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDocument extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'user_id',
        'name',
        'date',
        'number',
        'description',
        'file',
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function archive()
    {
        return $this->morphOne(Archive::class, 'archivable');
    }
}
