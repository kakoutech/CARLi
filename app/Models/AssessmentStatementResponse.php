<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStatementResponse extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function explanation()
    {
        $answer = $this->answer;
        if (! $answer) {
            return null;
        }

        $statement = AssessmentStatement::where('id', $this->assessment_statement_id)->first();

        if (! $statement) {
            return null;
        }

        return $statement->{'scale_'.$answer.'_explanation'};
    }
}
