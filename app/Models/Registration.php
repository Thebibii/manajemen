<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Registration.php
class Registration extends Model
{
    protected $fillable = ['event_id', 'user_id', 'status', 'ticket_code'];

    protected $casts = ['event_id' => 'integer', 'user_id' => 'integer'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
