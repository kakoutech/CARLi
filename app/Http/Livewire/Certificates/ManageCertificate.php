<?php

namespace App\Http\Livewire\Certificates;

use App\Models\Certificate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCertificate extends Component
{
    use WithFileUploads;

    public $background_file;
    public $signature_file;
    public $background_image_path;
    public $background_image_path_raw;
    public $signature_image_path;
    public $signature_image_path_raw;
    public $certificate;

    public $rules = [
        'background_file' => [],
        'signature_file' => [],
        'certificate.name' => ['required'],
        'certificate.show_title' => [],
        'certificate.show_body' => [],
        'certificate.show_students_name' => [],
        'certificate.show_date' => [],
        'certificate.show_footer' => [],
        'certificate.show_signature' => [],
        'certificate.title_data' => [],
        'certificate.title_position_x' => [],
        'certificate.title_position_y' => [],
        'certificate.title_font_size' => [],
        'certificate.title_font_family' => [],
        'certificate.title_font_color' => [],
        'certificate.body_data' => [],
        'certificate.body_position_x' => [],
        'certificate.body_position_y' => [],
        'certificate.body_font_size' => [],
        'certificate.body_font_family' => [],
        'certificate.body_font_color' => [],
        'certificate.student_name_position_x' => [],
        'certificate.student_name_position_y' => [],
        'certificate.student_name_font_size' => [],
        'certificate.student_name_font_family' => [],
        'certificate.student_name_font_color' => [],
        'certificate.date_position_x' => [],
        'certificate.date_position_y' => [],
        'certificate.date_font_size' => [],
        'certificate.date_font_family' => [],
        'certificate.date_font_color' => [],
        'certificate.signature_image_path' => [],
        'certificate.signature_position_x' => [],
        'certificate.signature_position_y' => [],
        'certificate.signature_image_height' => [],
        'certificate.signature_image_width' => [],
        'certificate.footer_data' => [],
        'certificate.footer_position_x' => [],
        'certificate.footer_position_y' => [],
        'certificate.footer_font_size' => [],
        'certificate.footer_font_family' => [],
        'certificate.footer_font_color' => [],
    ];


    public function mount($certificate)
    {
        $this->certificate = $certificate;

        if (!$this->certificate) {
            $this->certificate = new Certificate();
        } else {
            $this->background_image_path = $this->certificate->getBackgroundImage();
            $this->background_image_path_raw = $this->certificate->background_image_path;
            $this->signature_image_path = $this->certificate->getSignatureImage();
            $this->signature_image_path_raw = $this->certificate->signaure_image_path;
        }
    }

    public function updated($property_name)
    {
        if ($property_name == 'background_file') {
            $this->background_image_path_raw = $this->background_file->store(
                'public/media/certificates',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $this->background_image_path = asset(str_replace('public', 'storage', $this->background_image_path_raw));
        }

        if ($property_name == 'signature_file') {
            $this->signature_image_path_raw = $this->signature_file->store(
                'public/media/certificates',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $this->signature_image_path = asset(str_replace('public', 'storage', $this->signature_image_path_raw));
        }
    }

    public function save()
    {
        $this->validate();

        $this->certificate->background_image_path = $this->background_image_path_raw;
        $this->certificate->signature_image_path = $this->signature_image_path_raw;
        $this->certificate->save();

        return redirect()->route('dashboard.certificates')->with(['success' => 'Certificate Saved.']);
    }

    public function toggle($option)
    {
        $this->certificate->{$option} = !$this->certificate->{$option};
    }

    public function groups()
    {
        return [
            'title' => [
                'title_data' => ['type' => 'text', 'name' => 'Title Text'],
                'title_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'title_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'title_font_size' => ['type' => 'number', 'name' => 'Font Size'],
                //'title_font_family' => ['type' => 'font', 'name' => 'Font Family'],
                'title_font_color' => ['type' => 'color', 'name' => 'Font Colour'],
                'show_title' => ['type' => 'boolean', 'name' => ''],
            ],
            'body' => [
                'body_data' => ['type' => 'text', 'name' => 'Body Text'],
                'body_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'body_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'body_font_size' => ['type' => 'number', 'name' => 'Font Size'],
                //'body_font_family' => ['type' => 'font', 'name' => 'Font Family'],
                'body_font_color' => ['type' => 'color', 'name' => 'Font Colour'],
                'show_body' => ['type' => 'boolean', 'name' => ''],
            ],
            'students_name' => [
                'student_name_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'student_name_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'student_name_font_size' => ['type' => 'number', 'name' => 'Font Size'],
                //'student_name_font_family' => ['type' => 'font', 'name' => 'Font Family'],
                'student_name_font_color' => ['type' => 'color', 'name' => 'Font Colour'],
                'show_students_name' => ['type' => 'boolean', 'name' => ''],
            ],
            'date' => [
                'date_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'date_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'date_font_size' => ['type' => 'number', 'name' => 'Font Size'],
                //'date_font_family' => ['type' => 'font', 'name' => 'Font Family'],
                'date_font_color' => ['type' => 'color', 'name' => 'Font Colour'],
                'show_date' => ['type' => 'boolean', 'name' => ''],
            ],
            'signature' => [
                'signature_image_path' => ['type' => 'signature', 'name' => 'File'],
                'signature_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'signature_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'signature_image_height' => ['type' => 'number', 'name' => 'Image Height'],
                'signature_image_width' => ['type' => 'number', 'name' => 'Image Width'],
                'show_signature' => ['type' => 'boolean', 'name' => ''],
            ],
            'footer' => [
                'footer_data' => ['type' => 'text', 'name' => 'Footer Text'],
                'footer_position_x' => ['type' => 'number', 'name' => 'Position X'],
                'footer_position_y' => ['type' => 'number', 'name' => 'Position Y'],
                'footer_font_size' => ['type' => 'number', 'name' => 'Font Size'],
                //'footer_font_family' => ['type' => 'font', 'name' => 'Font Family'],
                'footer_font_color' => ['type' => 'color', 'name' => 'Font Colour'],
                'show_footer' => ['type' => 'boolean', 'name' => ''],
            ]
        ];
    }

    public function render()
    {
        return view(
            'livewire.certificates.manage-certificate',
            [
                'groups' => $this->groups()
            ]
        );
    }
}
