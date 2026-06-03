<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE CONFIG
    |--------------------------------------------------------------------------
    */

    protected $table = 'reservasis';

    protected $primaryKey = 'id_reservasi';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tanggal_reservasi' => 'date',
        'waktu'             => 'datetime:H:i',
        'jumlah_penumpang'  => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | STATUS CONSTANT
    |--------------------------------------------------------------------------
    */

    public const STATUS_PENDING   = 'Pending';

    public const STATUS_PROCESS   = 'Diproses';

    public const STATUS_CONFIRMED = 'Dikonfirmasi';

    public const STATUS_CANCELLED = 'Dibatalkan';

    /*
    |--------------------------------------------------------------------------
    | ROUTE MODEL BINDING
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName(): string
    {
        return 'id_reservasi';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function armada()
    {
        return $this->belongsTo(
            Armada::class,
            'id_armada',
            'id_armada'
        );
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
    | STATUS ACCESSOR
    |--------------------------------------------------------------------------
    */

    /**
     * Normalized status
     */
    public function getStatusAttribute(): string
    {
        return strtolower($this->status_reservasi);
    }

    /**
     * Human readable label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_reservasi) {

            self::STATUS_PENDING =>
            'Pending',

            self::STATUS_PROCESS =>
            'Diproses',

            self::STATUS_CONFIRMED =>
            'Dikonfirmasi',

            self::STATUS_CANCELLED =>
            'Dibatalkan',

            default =>
            'Unknown',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS BADGE
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status_reservasi) {

            self::STATUS_PENDING =>
            'bg-yellow-100 text-yellow-700',

            self::STATUS_PROCESS =>
            'bg-blue-100 text-blue-700',

            self::STATUS_CONFIRMED =>
            'bg-green-100 text-green-700',

            self::STATUS_CANCELLED =>
            'bg-red-100 text-red-700',

            default =>
            'bg-slate-100 text-slate-700',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS HELPER
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status_reservasi
            === self::STATUS_PENDING;
    }

    public function isProcess(): bool
    {
        return $this->status_reservasi
            === self::STATUS_PROCESS;
    }

    public function isConfirmed(): bool
    {
        return $this->status_reservasi
            === self::STATUS_CONFIRMED;
    }

    public function isCancelled(): bool
    {
        return $this->status_reservasi
            === self::STATUS_CANCELLED;
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS OPTIONS
    |--------------------------------------------------------------------------
    */

    public static function statusOptions(): array
    {
        return [

            self::STATUS_PENDING =>
            'Pending',

            self::STATUS_PROCESS =>
            'Diproses',

            self::STATUS_CONFIRMED =>
            'Dikonfirmasi',

            self::STATUS_CANCELLED =>
            'Dibatalkan',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FORMATTER
    |--------------------------------------------------------------------------
    */

    public function getFormattedTanggalAttribute(): string
    {
        return $this->tanggal_reservasi
            ? $this->tanggal_reservasi
            ->translatedFormat('d F Y')
            : '-';
    }

    public function getFormattedWaktuAttribute(): string
    {
        return $this->waktu
            ? Carbon::parse($this->waktu)
            ->format('H:i') . ' WIB'
            : '-';
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT STATUS
    |--------------------------------------------------------------------------
    */

    public function getPaymentStatusAttribute(): string
    {
        return $this->pembayaran?->status_pembayaran
            ?? 'Belum Bayar';
    }

    public function getPaymentBadgeAttribute(): string
    {
        if (!$this->pembayaran) {

            return 'bg-red-100 text-red-700';
        }

        return match ($this->pembayaran->status_pembayaran) {

            'DP' =>
            'bg-yellow-100 text-yellow-700',

            'Lunas' =>
            'bg-green-100 text-green-700',

            default =>
            'bg-red-100 text-red-700',
        };
    }
}
