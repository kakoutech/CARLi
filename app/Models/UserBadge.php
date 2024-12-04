<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(BadgeLevel::class, 'badge_level_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
