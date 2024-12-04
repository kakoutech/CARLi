<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualClassAttachment extends Model
{
    use HasFactory;

    public function classes()
    {
        return $this->hasMany(VirtualClass::class, 'virtual_class', 'id');
    }
}
