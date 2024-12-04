<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentGroupMarking extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(AssessmentGroup::class, 'assessment_group_id', 'id');
    }
}
