<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'signaturable_id',
        'signaturable_type',
        'payload',
    ];

    public function signaturable()
    {
        return $this->morphTo();
    }

    public static function buildPayload($data, $signer = null)
    {
        if ($signer == null) {
            $user = auth()->user();
        } else {
            $user = $signer;
        }

        return json_encode([
            'signer' => [
                'name' => $user->name,
                'nip' => ($user->nip) ? $user->nip : '',
                'position' => ($user->position) ? $user->position->name : '',
                'signed_at' => now()->isoFormat('dddd DD MMMM YYYY'),
            ],
            'details' => $data
        ]);
    }
}
