<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_reservasi',
        'harga_awal',
        'harga_final',
        'denda',
        'dp',
        'sisa_pembayaran',
        'total_bayar',
        'status_pembayaran',
        'metode_pembayaran',
        'tanggal_pembayaran',
    ];

    protected $casts = [
        'harga_awal' => 'integer',
        'harga_final' => 'integer',
        'denda' => 'integer',
        'dp' => 'integer',
        'sisa_pembayaran' => 'integer',
        'total_bayar' => 'integer',
        'tanggal_pembayaran' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | STATUS CONSTANT
    |--------------------------------------------------------------------------
    */

    public const STATUS_BELUM_BAYAR = 'Belum Bayar';
    public const STATUS_DP = 'DP';
    public const STATUS_LUNAS = 'Lunas';

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function reservasi()
    {
        return $this->belongsTo(
            Reservasi::class,
            'id_reservasi',
            'id_reservasi'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function isLunas(): bool
    {
        return $this->status_pembayaran === self::STATUS_LUNAS;
    }

    public function isDP(): bool
    {
        return $this->status_pembayaran === self::STATUS_DP;
    }

    public function isBelumBayar(): bool
    {
        return $this->status_pembayaran === self::STATUS_BELUM_BAYAR;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getFormattedHargaFinalAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->harga_final,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedDpAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->dp,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedSisaPembayaranAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->sisa_pembayaran,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedDendaAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->denda,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedTotalBayarAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->total_bayar,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedTanggalPembayaranAttribute(): string
    {
        return $this->tanggal_pembayaran
            ? $this->tanggal_pembayaran->format('d M Y')
            : '-';
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS OPTIONS
    |--------------------------------------------------------------------------
    */

    public static function statusOptions(): array
    {
        return [
            self::STATUS_BELUM_BAYAR => 'Belum Bayar',
            self::STATUS_DP => 'DP',
            self::STATUS_LUNAS => 'Lunas',
        ];
    }
}
