<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDF;

class UserCertificate extends Model
{
    use HasFactory;

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function awardedBy()
    {
        return $this->belongsTo(User::class, 'awarded_by', 'id');
    }

    public function pdf()
    {
        $pdf = PDF::loadView(
            'dashboard.certificates.partials.pdf',
            [
                'user_certificate' => $this,
                'data' => json_decode($this->certificate_data, true)
            ],
            [],
            [
                'format' => 'A4-L'
            ]
        );

        return $pdf;
    }
}
