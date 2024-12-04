<?php

require __DIR__ . '/Permissions.php';
require __DIR__ . '/Menus.php';

use App\Models\User;
use App\Models\Language;

function user()
{
    return auth()->user();
}

function getReportingPreferences()
{
    return [
        [
            'name' => 'View data per learner',
            'value' => 'per-learner'
        ],
        [
            'name' => 'View data per organisation',
            'value' => 'per-org'
        ]
    ];
}

function getVirtualClassRecurrences()
{
    return [
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'fortnightly' => 'Fortnightly',
        'monthly' => 'Monthly',
    ];
}

function getLanguages()
{
    return Language::all();
}

function getFormats()
{
    return ['PDF', 'Video', 'Podcast', 'Audio', 'Image', 'Text'];
}

function getCoursePreferences()
{
    return [
        [
            'name' => 'Care Home',
            'value' => 'care-home',
        ],
        [
            'name' => 'Dementia',
            'value' => 'dementia',
        ],
        [
            'name' => 'Autism and Learning Disability',
            'value' => 'autism',
        ],
        [
            'name' => 'Mental Health',
            'value' => 'mental-health',
        ],
        [
            'name' => 'Equality Diversity and Inclusion',
            'value' => 'equiality',
        ],
    ];
}

function getTrainers()
{
    if (auth()->user()->isSuperAdmin()) {
        return User::where('account_type', '=', 'trainer')->select('id', 'first_name', 'last_name')->get();
    }

    if (auth()->user()->isEmployer()) {
        return User::query()->byEmployer(auth()->user()->id)->where('account_type', '=', 'trainer')->select('id', 'first_name', 'last_name')->get();
    }

    if (auth()->user()->isTrainer()) {
        return User::query()->byEmployer(auth()->user()->employer_id)->where('account_type', '=', 'trainer')->select('id', 'first_name', 'last_name')->get();
    }
}

function getLearners()
{
    if (auth()->user()->isSuperAdmin()) {
        return User::where('account_type', '=', 'learner')->select('id', 'first_name', 'last_name')->get();
    }

    if (auth()->user()->isEmployer()) {
        return User::query()->byEmployer(auth()->user()->id)->where('account_type', '=', 'learner')->select('id', 'first_name', 'last_name')->get();
    }

    if (auth()->user()->isTrainer()) {
        return User::query()->byEmployer(auth()->user()->employer_id)->where('account_type', '=', 'learner')->select('id', 'first_name', 'last_name')->get();
    }
}

function getEmployers()
{
    return User::where('account_type', '=', 'employer')->select('id', 'company_name', 'first_name', 'last_name')->get();
}
