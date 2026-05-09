<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_pelanggan',
        'id_armada',
        'tanggal_reservasi',
        'waktu',
        'tujuan',
        'jumlah_penumpang',
        'status_reservasi',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
        'waktu' => 'datetime:H:i',
        'jumlah_penumpang' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Constant
    |--------------------------------------------------------------------------
    */

    public const STATUS_PENDING   = 'Pending';
    public const STATUS_CONFIRMED = 'Dikonfirmasi';
    public const STATUS_CANCELLED = 'Dibatalkan';

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName()
    {
        return "id_reservasi";
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class, 'id_armada');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function pembayaran()
    {
        return $this->hasOne(
            Pembayaran::class,
            'id_reservasi',
            'id_reservasi'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS NORMALIZATION (CORE FIX)
    |--------------------------------------------------------------------------
    */

    /**
     * Normalisasi (lowercase) untuk logic
     */
    public function getStatusAttribute(): string
    {
        return strtolower($this->status_reservasi);
    }

    /**
     * Label untuk ditampilkan (tetap mengikuti format database)
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_reservasi) {
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Dikonfirmasi',
            self::STATUS_CANCELLED => 'Dibatalkan',
            default => 'Unknown',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Statu Helper
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status_reservasi === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status_reservasi === self::STATUS_CONFIRMED;
    }

    public function isCancelled(): bool
    {
        return $this->status_reservasi === self::STATUS_CANCELLED;
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Dikonfirmasi',
            self::STATUS_CANCELLED => 'Dibatalkan',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Formatter
    |--------------------------------------------------------------------------
    */

    public function getFormattedTanggalAttribute(): string
    {
        return $this->tanggal_reservasi
            ? $this->tanggal_reservasi->format('d M Y')
            : '-';
    }

    public function getFormattedWaktuAttribute(): string
    {
        return $this->waktu
            ? Carbon::parse($this->waktu)->format('H:i') . ' WIB'
            : '-';
    }

}
