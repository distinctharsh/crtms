<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonVisibilityRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'role_id',
        'button_type',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
} 