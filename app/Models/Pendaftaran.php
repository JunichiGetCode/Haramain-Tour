<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'rombongan_id',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'alamat_lengkap',
        'nama_mahram',
        'foto_ktp',
        'foto_paspor',
        'foto_visa',
        'foto_buku_vaksin',
        'riwayat_penyakit',
        'golongan_darah',
        'metode_pembayaran',
        'jumlah_bayar',
        'bukti_pembayaran',
        'snap_token',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'payment_status',
        'status',
        'catatan_admin',
        'tanda_tangan_digital',
        'pas_foto',
        'surat_perjanjian_accepted_at',
        'persyaratan_accepted_at',
        'refund_status',
        'catatan_refund',
        'kode_booking',
        'nomor_paspor',
        'nomor_kamar',
        'fcm_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'jumlah_bayar' => 'integer',
        'surat_perjanjian_accepted_at' => 'datetime',
        'persyaratan_accepted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function rombongan()
    {
        return $this->belongsTo(Rombongan::class);
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * Get total amount paid
     */
    public function getTotalBayarAttribute()
    {
        return $this->pembayarans()->where('payment_status', 'paid')->sum('amount');
    }

    /**
     * Get remaining bill
     */
    public function getSisaTagihanAttribute()
    {
        $hargaPaket = $this->jumlah_bayar ?: ($this->paket->harga ?? 0);
        return $hargaPaket - $this->total_bayar;
    }



    /**
     * Badge warna status
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'info',
        };
    }

    /**
     * Label status dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => __('Menunggu Review'),
            'approved' => __('Disetujui'),
            'rejected' => __('Ditolak'),
            default => $this->status,
        };
    }

    /**
     * Badge warna payment status
     */
    public function getPaymentStatusBadgeAttribute()
    {
        if ($this->payment_status === 'unpaid' && $this->total_bayar > 0) {
            return 'info';
        }

        return match ($this->payment_status) {
            'unpaid' => 'warning',
            'paid' => 'success',
            'expired' => 'secondary',
            'failed' => 'danger',
            default => 'info',
        };
    }

    /**
     * Label payment status dalam Bahasa Indonesia
     */
    public function getPaymentStatusLabelAttribute()
    {
        if ($this->payment_status === 'unpaid' && $this->total_bayar > 0) {
            return __('Belum Lunas');
        }

        return match ($this->payment_status) {
            'unpaid' => __('Belum Bayar'),
            'paid' => __('Sudah Bayar'),
            'expired' => __('Kadaluarsa'),
            'failed' => __('Gagal'),
            default => $this->payment_status,
        };
    }


    /**
     * Format jumlah bayar ke Rupiah
     */
    public function getJumlahBayarRupiahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_bayar, 0, ',', '.');
    }

    /**
     * Label metode pembayaran
     */
    public function getMetodePembayaranLabelAttribute()
    {
        return match ($this->metode_pembayaran) {
            'transfer_bca' => 'Transfer BCA',
            'transfer_mandiri' => 'Transfer Mandiri',
            'transfer_bni' => 'Transfer BNI',
            'bank_transfer' => 'Bank Transfer (VA)',
            'echannel' => 'Mandiri Bill',
            'bca_klikpay' => 'BCA KlikPay',
            'bca_klikbca' => 'KlikBCA',
            'bri_epay' => 'BRI E-Pay',
            'cimb_clicks' => 'CIMB Clicks',
            'danamon_online' => 'Danamon Online',
            'credit_card' => __('Kartu Kredit'),
            'gopay' => 'GoPay',
            'shopeepay' => 'ShopeePay',
            'qris' => 'QRIS',
            'cstore' => 'Indomaret/Alfamart',
            'akulaku' => 'Akulaku',
            default => $this->metode_pembayaran ?? __('Belum dipilih'),
        };
    }
}
