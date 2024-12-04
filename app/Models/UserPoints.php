<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    use HasFactory;

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->whereHas('user', function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', $search)->orWhere('last_name', 'LIKE', $search);
            })->orWhere('action', 'LIKE', $search);
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAction()
    {
        $action = $this->action;

        $action = str_replace('_', ' ', $action);

        return ucwords($action);
    }
}
