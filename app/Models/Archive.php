<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Archive extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = ['number', 'archivable_type', 'archivable_id'];

    public function archivable()
    {
        return $this->morphTo();
    }

    protected static function booted()
    {
        static::creating(function ($archive) {
            $archive->number = 'ARC' . Str::upper(Str::random(6)) . date('mY');
        });
    }
}
