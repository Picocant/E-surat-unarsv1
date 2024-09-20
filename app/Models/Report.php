<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'name',
        'type',
        'data',
    ];

    public function signature()
    {
        return $this->morphOne(Signature::class, 'signaturable');
    }

    public static function generate(
        ?string $name,
        string $type,
        string $title,
        array $filters,
        mixed $body
    ) {
        $report = new Report();
        $report->name = $name;
        $report->type = $type;
        $report->data = json_encode([
            'title' => $title,
            'filters' => $filters,
            'body' => $body,
        ]);
        $report->save();
        $report->signature()->save(new Signature([
            'payload' => Signature::buildPayload([
                'Tipe' => self::getType($type),
            ])
        ]));
    }

    public static function type(string $type)
    {
        return Report::where('type', $type)->orderBy('created_at', 'DESC');
    }

    protected static function getType(string $type)
    {
        if ($type === IncomingLetter::class) {
            return 'Laporan Surat Masuk';
        } elseif ($type === IncomingLetterDisposition::class) {
            return 'Laporan Disposisis Surat Masuk';
        } else {
            return 'Laporan';
        }
    }
}
