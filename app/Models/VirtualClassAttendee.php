<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualClassAttendee extends Model
{
    use HasFactory;

    public function learner()
    {
        return $this->belongsTo(User::class, 'learner_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(VirtualClass::class, 'virtual_class_id', 'id');
    }
}
