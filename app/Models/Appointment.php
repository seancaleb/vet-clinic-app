<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
