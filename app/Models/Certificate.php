<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function getBackgroundImage()
    {
        if (!$this->background_image_path) {
            return null;
        }

        return asset(str_replace('public', 'storage', $this->background_image_path));
    }

    public function getSignatureImage()
    {
        if (!$this->signature_image_path) {
            return null;
        }

        return asset(str_replace('public', 'storage', $this->signature_image_path));
    }

    public function getName()
    {
        return $this->name;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function awards()
    {
        return $this->hasMany(UserCertificate::class, 'certificate_id', 'id');
    }

    public function getAwardCount()
    {
        return $this->awards()->count();
    }

    public function awardTo(User $user)
    {
        $award = new UserCertificate();
        $award->user_id = $user->id;
        $award->certificate_id = $this->id;
        $award->certificate_data = json_encode($this->toArray());
        $award->awarded_by = auth()->user()->id;
        $award->save();

        Gamification::addCertificatePoints($user);

        return $award;
    }
}
