<?php

namespace App\Http\Livewire\Certificates;

use App\Models\Certificate;
use Livewire\Component;
use App\Models\User;
use App\Notifications\CertificateAwarded;

class Award extends Component
{
    public $certificate_id;
    public $student_id;

    public $rules = [
        'student_id' => ['required'],
    ];

    public function mount($certificate_id = null, $student_id = null)
    {
        $this->certificate_id = $certificate_id;
        $this->student_id = $student_id;
    }

    public function award()
    {
        $this->validate();

        $learner = User::find($this->student_id);
        if (!$learner) {
            $this->addError('student_id', 'You must select a valid learner.');
            return;
        }

        $certificate = Certificate::find($this->certificate_id);
        if (!$certificate) {
            $this->addError('certificate_id', 'You must select a valid certificate.');
            return;
        }

        $certificate->awardTo($learner);

        $learner->notify(new CertificateAwarded($certificate));

        return redirect()->route('dashboard.learners.view', [$learner->id, 'tab' => 'certificates'])->with(['success' => 'Certificate Awarded.']);
    }

    public function render()
    {
        return view(
            'livewire.certificates.award',
            [
                'learners' => getLearners(),
                'certificates' => Certificate::query()->orderBy('name', 'ASC')->get()
            ]
        );
    }
}
