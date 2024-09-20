<?php

namespace App\Traits;

use App\Models\Letter;

trait Letterable
{
    public function letter()
    {
        return $this->morphOne(Letter::class, 'letterable');
    }
}