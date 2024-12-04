<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentHubController extends Controller
{
    public function index(Request $request)
    {
        return view(
            'assessment-hub.main',
        );
    }

    public function viewPersonality(Request $request)
    {
        return view(
            'assessment-hub.personality-assessment',
        );
    }

    public function viewResilience(Request $request)
    {
        return view(
            'assessment-hub.resilience-assessment',
        );
    }

    public function viewWellbeing(Request $request)
    {
        return view(
            'assessment-hub.wellbeing-assessment',
        );
    }
}
