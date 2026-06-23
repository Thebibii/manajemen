<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Event.php
class Event extends Model
{
    protected $fillable = ['user_id', 'nama', 'deskripsi', 'tanggal', 'lokasi', 'kuota', 'gambar'];


    protected $casts = ['tanggal' => 'datetime', 'user_id' => 'integer', 'kuota' => 'integer'];


    public function panitia()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function jumlahDiterima(): int
    {
        return $this->registrations()->where('status', 'diterima')->count();
    }

    // public function sisaKuota(): int
    // {
    //     return max(0, $this->kuota - $this->jumlahDiterima());
    // }

    // App/Models/Event.php
    public function getSisaKuotaAttribute(): int
    {
        return $this->kuota - $this->registrations_count;
    }
}
