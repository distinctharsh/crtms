<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTransition extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_status_id',
        'to_status_id',
        'role_id',
    ];

    public function fromStatus() {
        return $this->belongsTo(Status::class, 'from_status_id');
    }
    public function toStatus() {
        return $this->belongsTo(Status::class, 'to_status_id');
    }
    public function role() {
        return $this->belongsTo(Role::class);
    }
} 