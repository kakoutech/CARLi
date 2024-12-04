<?php

function getMenus()
{
    return getMenuByRole(user()->account_type);
}

function getMenuByRole($role)
{

    if ($role == 'admin') {
        return getSuperAdminMenus();
    }

    if ($role == 'trainer') {
        return getTrainerMenus();
    }

    if ($role == 'employer') {
        return getEmployerMenus();
    }

    if ($role == 'learner') {
        return getLearnerMenus();
    }

    return [];
}

function getSuperAdminMenus()
{
    $menus = [];

    // Dashboard
    $menus[] = [
        'name' => 'Dashboard',
        'slug' => 'dashboard',
        'route' => route('dashboard'),
        'is_route' => request()->is('dashboard') || request()->is('dashboard/messaging') || request()->is('dashboard/notifications'),
        'icon' => 'home',
        'has_children' => true,
        'children' => [
            ['name' => 'Dashboard', 'slug' => 'dashoard', 'route' => route('dashboard'), 'is_route' => request()->is('dashboard')],
            ['name' => 'Notifications', 'slug' => 'notifications', 'route' => route('dashboard.notifications'), 'is_route' => request()->is('dashboard/notifications*')],
            ['name' => 'Messages', 'slug' => 'messages', 'route' => route('dashboard.messaging'), 'is_route' => request()->is('dashboard/messaging*')],
        ],
    ];

    // Learners
    $menus[] = [
        'name' => 'Learners',
        'slug' => 'learners',
        'route' => route('dashboard.learners'),
        'is_route' => request()->is('dashboard/learners*'),
        'icon' => 'learners',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Student List', 'slug' => 'learners', 'route' => route('dashboard.learners'), 'is_route' => request()->is('dashboard/learners') ||
                    (request()->is('dashboard/learners/*') && !request()->is('dashboard/learners/new')),
            ],
            ['name' => 'New Student', 'slug' => 'learners.add', 'route' => route('dashboard.learners.add'), 'is_route' => request()->is('dashboard/learners/new')],
            ['name' => 'Enrolled Students', 'slug' => 'learners.enrolled', 'route' => route('dashboard.learners.enrolled'), 'is_route' => request()->is('dashboard/learners/enrolled')],
            ['name' => 'New Enroll', 'slug' => 'learners.new-enroll', 'route' => route('dashboard.learners.enrolled.enroll'), 'is_route' => request()->is('dashboard/learners/enrolled/new')],
            ['name' => 'Deleted Students', 'slug' => 'learners.deleted', 'route' => route('dashboard.learners.deleted'), 'is_route' => request()->is('dashboard/learners/deleted')],
            //['name' => 'Settings', 'slug'= > 'learners.settings', 'route' => route('dashboard.learners.settings'), 'is_route' => request()->is('dashboard/learners/settings')],
        ],
    ];

    // Trainers
    $menus[] = [
        'name' => 'Trainers',
        'slug' => 'trainers',
        'route' => route('dashboard.trainers'),
        'is_route' => request()->is('dashboard/trainers*'),
        'icon' => 'trainers',
        'has_children' => true,
        'children' => [
            [
                'name' => 'All Trainers', 'slug' => 'trainers', 'route' => route('dashboard.trainers'), 'is_route' => request()->is('dashboard/trainers') ||
                    (request()->is('dashboard/trainers/*') && !request()->is('dashboard/trainers/new')),
            ],
            ['name' => 'New Trainer', 'slug' => 'trainers.add', 'route' => route('dashboard.trainers.add'), 'is_route' => request()->is('dashboard/trainers/new*')],
            ['name' => 'Deleted Trainers', 'slug' => 'trainers.deleted', 'route' => route('dashboard.trainers.deleted'), 'is_route' => request()->is('dashboard/trainers/deleted')],
            //['name' => 'Settings', 'slug' => 'trainers.settings', 'route' => route('dashboard.trainers.settings'), 'is_route' => request()->is('dashboard/trainers/settings*')],
        ],
    ];

    // Employers
    $menus[] = [
        'name' => 'Employers',
        'slug' => 'employers',
        'route' => route('dashboard.employers'),
        'is_route' => request()->is('dashboard/employers*'),
        'icon' => 'employers',
        'has_children' => true,
        'children' => [
            [
                'name' => 'All Employers', 'slug' => 'employers', 'route' => route('dashboard.employers'), 'is_route' => request()->is('dashboard/employers') ||
                    (request()->is('dashboard/employers/*') && !request()->is('dashboard/employers/new')),
            ],
            ['name' => 'New Employer', 'slug' => 'employers.add', 'route' => route('dashboard.employers.add'), 'is_route' => request()->is('dashboard/employers/new*')],
            ['name' => 'Deleted Employers', 'slug' => 'employers.deleted', 'route' => route('dashboard.employers.deleted'), 'is_route' => request()->is('dashboard/employers/deleted')],
            //['name' => 'Settings', 'slug' => 'employers.settings', 'route' => route('dashboard.employers.settings'), 'is_route' => request()->is('dashboard/employers/settings*')],
        ],
    ];

    // CMS
    $menus[] = [
        'name' => 'CMS',
        'slug' => 'cms',
        'route' => route('dashboard.cms'),
        'is_route' => request()->is('dashboard/cms*'),
        'icon' => 'cms',
        'has_children' => true,
        'children' => [
            ['name' => 'Page List', 'slug' => 'cms', 'route' => route('dashboard.cms'), 'is_route' => request()->is('dashboard/cms') || request()->is('dashboard/cms/*/edit')],
            ['name' => 'New Page', 'slug' => 'cms.add', 'route' => route('dashboard.cms.add'), 'is_route' => request()->is('dashboard/cms/new*')],
            ['name' => 'Deleted Pages', 'slug' => 'cms.deleted', 'route' => route('dashboard.cms.deleted'), 'is_route' => request()->is('dashboard/cms/deleted')],
        ],
    ];

    // Tools & Resources
    $menus[] = [
        'name' => 'Tools & Resources',
        'slug' => 'tools-and-resources',
        'route' => route('dashboard.courses'),
        'is_route' => request()->is('dashboard/tools-and-resources*'),
        'icon' => 'tools',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Course List', 'slug' => 'courses', 'route' => route('dashboard.courses'), 'is_route' => request()->is('dashboard/tools-and-resources/courses') ||
                    (request()->is('dashboard/tools-and-resources/courses/*') && !request()->is('dashboard/tools-and-resources/courses/new')),
            ],
            ['name' => 'New Course', 'slug' => 'courses.add', 'route' => route('dashboard.courses.add'), 'is_route' => request()->is('dashboard/tools-and-resources/courses/new')],
            [
                'name' => 'MCQs', 'slug' => 'mcqs', 'route' => route('dashboard.courses.mcqs'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs') || request()->is('dashboard/tools-and-resources/mcqs/*/edit'),
            ],
            ['name' => 'New MCQ Set', 'slug' => 'mcqs.add', 'route' => route('dashboard.courses.mcqs.add'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs/new')],

            ['name' => 'Topic List', 'slug' => 'topics', 'route' => route('dashboard.courses.topics'), 'is_route' => request()->is('dashboard/tools-and-resources/topics') || request()->is('dashboard/tools-and-resources/topics/*/edit')],
            ['name' => 'New Topic', 'slug' => 'topics.add', 'route' => route('dashboard.courses.topics.add'), 'is_route' => request()->is('dashboard/tools-and-resources/topics/new')],
            ['name' => 'Resource Library', 'slug' => 'course-resources', 'route' => route('dashboard.courses.resources'), 'is_route' => request()->is('dashboard/tools-and-resources/resources') || request()->is('dashboard/tools-and-resources/resources/*/edit')],
            //['name' => 'New Resource', 'slug' => 'course-resources.add', 'route' => route('dashboard.courses.resources.add'), 'is_route' => request()->is('dashboard/tools-and-resources/resources/new')],
        ],
    ];

    // Assessments
    $menus[] = [
        'name' => 'Assessments',
        'slug' => 'assessments',
        'route' => route('dashboard.assessments'),
        'is_route' => request()->is('dashboard/assessments*'),
        'icon' => 'assessments',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Assessment List', 'slug' => 'assessments', 'route' => route('dashboard.assessments'), 'is_route' => request()->is('dashboard/assessments') || request()->is('dashboard/assessments/*/edit'),
            ],
            ['name' => 'New Assessment', 'slug' => 'assessments.add', 'route' => route('dashboard.assessments.add'), 'is_route' => request()->is('dashboard/assessments/new')],
        ],
    ];

    // Gamification
    $menus[] = [
        'name' => 'Gamification',
        'slug' => 'gamification',
        'route' => route('dashboard.gamification'),
        'is_route' => request()->is('dashboard/gamification*'),
        'icon' => 'badges',
        'has_children' => true,
        'children' => [
            ['name' => 'History', 'slug' => 'gamification.history', 'route' => route('dashboard.gamification.history'), 'is_route' => request()->is('dashboard/gamification/history*')],
            ['name' => 'Badges', 'slug' => 'gamification.badges', 'route' => route('dashboard.gamification.badges'), 'is_route' => request()->is('dashboard/gamification/badges*')],
            ['name' => 'Settings', 'slug' => 'gaminification.settings', 'route' => route('dashboard.gamification.settings'), 'is_route' => request()->is('dashboard/gamification/settings')],
        ],
    ];

    // Certificate
    $menus[] = [
        'name' => 'Certificate',
        'slug' => 'certificate',
        'route' => route('dashboard.certificates'),
        'is_route' => request()->is('dashboard/certificates*'),
        'icon' => 'certificates',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Certificates', 'slug' => 'certificates', 'route' => route('dashboard.certificates'), 'is_route' => request()->is('dashboard/certificates')
                    || (request()->is('dashboard/certificates/*') && !request()->is('dashboard/certificates/new')),
            ],
            ['name' => 'New Certificate', 'slug' => 'certificates.new', 'route' => route('dashboard.certificates.add'), 'is_route' => request()->is('dashboard/certificates/new*')],
            //['name' => 'Award Certificate', 'slug' => 'certificates.award', 'route' => route('dashboard.certificates.award'), 'is_route' => request()->is('dashboard/certificates/award*')],
        ],
    ];

    // Virtual Class
    $menus[] = [
        'name' => 'Virtual Class',
        'slug' => 'virtual-class',
        'route' => route('dashboard.virtual-classes'),
        'is_route' => request()->is('dashboard/virtual-classes*'),
        'icon' => 'virtual-classes',
        'has_children' => true,
        'children' => [
            ['name' => 'Virtual Class List', 'slug' => 'virtual-classes', 'route' => route('dashboard.virtual-classes'), 'is_route' => request()->is('dashboard/virtual-classes') || request()->is('dashboard/virtual-classes/*/edit')],
            ['name' => 'New Virtual Class', 'slug' => 'virtual-classes.add', 'route' => route('dashboard.virtual-classes.add'), 'is_route' => request()->is('dashboard/virtual-classes/new*')],
            ['name' => 'Past Classes', 'slug' => 'virtual-classes.past', 'route' => route('dashboard.virtual-classes.past'), 'is_route' => request()->is('dashboard/virtual-classes/past')],
        ],
    ];

    // Reflective Journal Management
    $menus[] = [
        'name' => 'Reflective Journal',
        'slug' => 'reflective-journal',
        'route' => route('dashboard.reflective-journal'),
        'is_route' => request()->is('dashboard/reflective-journal*'),
        'icon' => 'journal',
        'has_children' => true,
        'children' => [
            ['name' => 'Question List', 'slug' => 'reflective-journal', 'route' => route('dashboard.reflective-journal'), 'is_route' => request()->is('dashboard/reflective-journal') || request()->is('dashboard/reflective-journal/*/edit')],
            ['name' => 'New Question', 'slug' => 'reflective-journal.add', 'route' => route('dashboard.reflective-journal.add'), 'is_route' => request()->is('dashboard/reflective-journal/new*')],
        ],
    ];

    // Strategy Tools
    $menus[] = [
        'name' => 'Strategy Tools',
        'slug' => 'strategy-tools',
        'route' => route('dashboard.strategy-tools.articles'),
        'is_route' => request()->is('dashboard/strategy-tools*'),
        'icon' => 'tools',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Tool List', 'slug' => 'strategy-tools',
                'route' => route('dashboard.strategy-tools.articles'), 'is_route' => request()->is('dashboard/strategy-tools/articles') ||
                    (request()->is('dashboard/strategy-tools/articles/*') && !request()->is('dashboard/strategy-tools/articles/new')),
            ],
            ['name' => 'New Tool', 'slug' => 'strategy-tools.add', 'route' => route('dashboard.strategy-tools.articles.add'), 'is_route' => request()->is('dashboard/strategy-tools/articles/new*')],
            ['name' => 'Topics', 'slug' => 'strategy-tools.topics', 'route' => route('dashboard.strategy-tools.topics'), 'is_route' => request()->is('dashboard/strategy-tools/topics') || request()->is('dashboard/strategy-tools/topics/*/edit')],
            ['name' => 'New Topic', 'slug' => 'strategy-tools.topics.add', 'route' => route('dashboard.strategy-tools.topics.add'), 'is_route' => request()->is('dashboard/strategy-tools/topics/new*')],
            ['name' => 'Resource Library', 'slug' => 'strategy-tools-resources', 'route' => route('dashboard.strategy-tools.resources'), 'is_route' => request()->is('dashboard/strategy-tools/resources') || request()->is('dashboard/strategy-tools/resources/*/edit')],
        ],
    ];

    // Super Admins
    $menus[] = [
        'name' => 'Super Admins',
        'slug' => 'super-admins',
        'route' => route('dashboard.super-admins'),
        'is_route' => request()->is('dashboard/super-admins*'),
        'icon' => 'admins',
        'has_children' => true,
        'children' => [
            ['name' => 'Staff List', 'slug' => 'super-admins', 'route' => route('dashboard.super-admins'), 'is_route' => request()->is('dashboard/super-admins') || request()->is('dashboard/super-admins/*/edit')],
            ['name' => 'New Super Admin', 'slug' => 'super-admins.add', 'route' => route('dashboard.super-admins.add'), 'is_route' => request()->is('dashboard/super-admins/new*')],
            ['name' => 'Deleted Super Admins', 'slug' => 'super-admins.deleted', 'route' => route('dashboard.super-admins.deleted'), 'is_route' => request()->is('dashboard/super-admins/deleted')],
            //['name' => 'Settings', 'slug' => 'super-admins.settings', 'route' => route('dashboard.super-admins.settings'), 'is_route' => request()->is('dashboard/super-admins/settings*')],
        ],
    ];

    return $menus;
}

function getTrainerMenus()
{
    $menus = [];

    // Dashboard
    $menus[] = [
        'name' => 'Dashboard',
        'slug' => 'dashboard',
        'route' => route('dashboard'),
        'is_route' => request()->is('dashboard') || request()->is('dashboard/messaging') || request()->is('dashboard/notifications'),
        'icon' => 'home',
        'has_children' => true,
        'children' => [
            ['name' => 'Dashboard', 'slug' => 'dashoard', 'route' => route('dashboard'), 'is_route' => request()->is('dashboard')],
            ['name' => 'Notifications', 'slug' => 'notifications', 'route' => route('dashboard.notifications'), 'is_route' => request()->is('dashboard/notifications*')],
            ['name' => 'Messages', 'slug' => 'messages', 'route' => route('dashboard.messaging'), 'is_route' => request()->is('dashboard/messaging*')],
        ],
    ];

    // Learners
    $menus[] = [
        'name' => 'Learners',
        'slug' => 'learners',
        'route' => route('dashboard.learners'),
        'is_route' => request()->is('dashboard/learners*'),
        'icon' => 'learners',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Student List', 'slug' => 'learners', 'route' => route('dashboard.learners'), 'is_route' => request()->is('dashboard/learners') ||
                    (request()->is('dashboard/learners/*') && !request()->is('dashboard/learners/new')),
            ],
            ['name' => 'New Student', 'slug' => 'learners.add', 'route' => route('dashboard.learners.add'), 'is_route' => request()->is('dashboard/learners/new')],
            ['name' => 'Enrolled Students', 'slug' => 'learners.enrolled', 'route' => route('dashboard.learners.enrolled'), 'is_route' => request()->is('dashboard/learners/enrolled')],
            ['name' => 'New Enroll', 'slug' => 'learners.new-enroll', 'route' => route('dashboard.learners.enrolled.enroll'), 'is_route' => request()->is('dashboard/learners/enrolled/new')],
            ['name' => 'Deleted Students', 'slug' => 'learners.deleted', 'route' => route('dashboard.learners.deleted'), 'is_route' => request()->is('dashboard/learners/deleted')],
            //['name' => 'Settings', 'slug'= > 'learners.settings', 'route' => route('dashboard.learners.settings'), 'is_route' => request()->is('dashboard/learners/settings')],
        ],
    ];

    // Tools and Resources
    $menus[] = [
        'name' => 'Tools & Resources',
        'slug' => 'tools-and-resources',
        'route' => route('dashboard.courses'),
        'is_route' => request()->is('dashboard/tools-and-resources*'),
        'icon' => 'tools',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Course List', 'slug' => 'courses', 'route' => route('dashboard.courses'), 'is_route' => request()->is('dashboard/tools-and-resources/courses') ||
                    (request()->is('dashboard/tools-and-resources/courses/*') && !request()->is('dashboard/tools-and-resources/courses/new')),
            ],
            ['name' => 'New Course', 'slug' => 'courses.add', 'route' => route('dashboard.courses.add'), 'is_route' => request()->is('dashboard/tools-and-resources/courses/new')],
            [
                'name' => 'MCQs', 'slug' => 'mcqs', 'route' => route('dashboard.courses.mcqs'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs') || request()->is('dashboard/tools-and-resources/mcqs/*/edit'),
            ],
            ['name' => 'New MCQ Set', 'slug' => 'mcqs.add', 'route' => route('dashboard.courses.mcqs.add'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs/new')],

            ['name' => 'Topic List', 'slug' => 'topics', 'route' => route('dashboard.courses.topics'), 'is_route' => request()->is('dashboard/tools-and-resources/topics') || request()->is('dashboard/tools-and-resources/topics/*/edit')],
            ['name' => 'New Topic', 'slug' => 'topics.add', 'route' => route('dashboard.courses.topics.add'), 'is_route' => request()->is('dashboard/tools-and-resources/topics/new')],
            ['name' => 'Resource Library', 'slug' => 'course-resources', 'route' => route('dashboard.courses.resources'), 'is_route' => request()->is('dashboard/tools-and-resources/resources') || request()->is('dashboard/tools-and-resources/resources/*/edit')],
            //['name' => 'New Resource', 'slug' => 'course-resources.add', 'route' => route('dashboard.courses.resources.add'), 'is_route' => request()->is('dashboard/tools-and-resources/resources/new')],
        ],
    ];

    // Assessments
    $menus[] = [
        'name' => 'Assessments',
        'slug' => 'assessments',
        'route' => route('dashboard.assessments'),
        'is_route' => request()->is('dashboard/assessments*'),
        'icon' => 'assessments',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Assessment List', 'slug' => 'assessments', 'route' => route('dashboard.assessments'), 'is_route' => request()->is('dashboard/assessments') || request()->is('dashboard/assessments/*/edit'),
            ],
            ['name' => 'New Assessment', 'slug' => 'assessments.add', 'route' => route('dashboard.assessments.add'), 'is_route' => request()->is('dashboard/assessments/new')],
        ],
    ];

    // Certificate
    $menus[] = [
        'name' => 'Certificate',
        'slug' => 'certificate',
        'route' => route('dashboard.certificates'),
        'is_route' => request()->is('dashboard/certificates*'),
        'icon' => 'certificates',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Certificates', 'slug' => 'certificates', 'route' => route('dashboard.certificates'), 'is_route' => request()->is('dashboard/certificates')
                    || (request()->is('dashboard/certificates/*') && !request()->is('dashboard/certificates/new')),
            ],
            ['name' => 'New Certificate', 'slug' => 'certificates.new', 'route' => route('dashboard.certificates.add'), 'is_route' => request()->is('dashboard/certificates/new*')],
            //['name' => 'Award Certificate', 'slug' => 'certificates.award', 'route' => route('dashboard.certificates.award'), 'is_route' => request()->is('dashboard/certificates/award*')],
        ],
    ];

    // Virtual Class
    $menus[] = [
        'name' => 'Virtual Class',
        'slug' => 'virtual-class',
        'route' => route('dashboard.virtual-classes'),
        'is_route' => request()->is('dashboard/virtual-classes*'),
        'icon' => 'virtual-classes',
        'has_children' => true,
        'children' => [
            ['name' => 'Virtual Class List', 'slug' => 'virtual-classes', 'route' => route('dashboard.virtual-classes'), 'is_route' => request()->is('dashboard/virtual-classes') || request()->is('dashboard/virtual-classes/*/edit')],
            ['name' => 'New Virtual Class', 'slug' => 'virtual-classes.add', 'route' => route('dashboard.virtual-classes.add'), 'is_route' => request()->is('dashboard/virtual-classes/new*')],
            ['name' => 'Past Classes', 'slug' => 'virtual-classes.past', 'route' => route('dashboard.virtual-classes.past'), 'is_route' => request()->is('dashboard/virtual-classes/past')],
        ],
    ];

    return $menus;
}

function getLearnerMenus()
{
    $menus = [];

    // Dashboard
    $menus[] = [
        'name' => 'Dashboard',
        'slug' => 'dashboard',
        'route' => route('dashboard'),
        'is_route' => request()->is('dashboard') || request()->is('dashboard/messaging') || request()->is('dashboard/notifications'),
        'icon' => 'home',
        'has_children' => true,
        'children' => [
            ['name' => 'Dashboard', 'slug' => 'dashoard', 'route' => route('dashboard'), 'is_route' => request()->is('dashboard')],
            ['name' => 'Notifications', 'slug' => 'notifications', 'route' => route('dashboard.notifications'), 'is_route' => request()->is('dashboard/notifications*')],
            ['name' => 'Messages', 'slug' => 'messages', 'route' => route('dashboard.messaging'), 'is_route' => request()->is('dashboard/messaging*')],
        ],
    ];

    // My Courses
    $menus[] = [
        'name' => 'My Courses',
        'slug' => 'my-courses',
        'route' => route('dashboard.my-courses'),
        'is_route' => request()->is('dashboard/my-courses*'),
        'icon' => 'courses',
        'has_children' => false
    ];

    // My Competency Tests
    $menus[] = [
        'name' => 'My Competency Tests',
        'slug' => 'my-competency-tests',
        'route' => route('dashboard.my-competency-tests'),
        'is_route' => request()->is('dashboard/my-competency-tests*'),
        'icon' => 'tests',
        'has_children' => false
    ];

    // My Classes
    $menus[] = [
        'name' => 'My Classes',
        'slug' => 'my-classes',
        'route' => route('dashboard.my-classes'),
        'is_route' => request()->is('dashboard/my-classes*'),
        'icon' => 'classes',
        'has_children' => false
    ];

    // Reflective Journal Management
    $menus[] = [
        'name' => 'Reflective Journal',
        'slug' => 'reflective-journal',
        'route' => route('dashboard.my-reflective-journal'),
        'is_route' => request()->is('dashboard/my-reflective-journal*'),
        'icon' => 'journal',
        'has_children' => true,
        'children' => [
            ['name' => 'Past Entries', 'slug' => 'my-reflective-journal', 'route' => route('dashboard.my-reflective-journal'), 'is_route' => request()->is('dashboard/my-reflective-journal')],
            ['name' => 'New Entry', 'slug' => 'my-reflective-journal', 'route' => route('dashboard.my-reflective-journal.new'), 'is_route' => request()->is('dashboard/my-reflective-journal/new')],
        ]
    ];

    // My Certificates
    $menus[] = [
        'name' => 'My Certificates',
        'slug' => 'my-certificates',
        'route' => route('dashboard.my-certificates'),
        'is_route' => request()->is('dashboard/my-certificates*'),
        'icon' => 'certificates',
        'has_children' => false
    ];

    // My Badges
    $menus[] = [
        'name' => 'My Badges',
        'slug' => 'my-badges',
        'route' => route('dashboard.my-badges'),
        'is_route' => request()->is('dashboard/my-badges*'),
        'icon' => 'badges',
        'has_children' => false
    ];

    return $menus;
}

function getEmployerMenus()
{
    $menus = [];

    // Dashboard
    $menus[] = [
        'name' => 'Dashboard',
        'slug' => 'dashboard',
        'route' => route('dashboard'),
        'is_route' => request()->is('dashboard') || request()->is('dashboard/messaging') || request()->is('dashboard/notifications'),
        'icon' => 'home',
        'has_children' => true,
        'children' => [
            ['name' => 'Dashboard', 'slug' => 'dashoard', 'route' => route('dashboard'), 'is_route' => request()->is('dashboard')],
            ['name' => 'Notifications', 'slug' => 'notifications', 'route' => route('dashboard.notifications'), 'is_route' => request()->is('dashboard/notifications*')],
            ['name' => 'Messages', 'slug' => 'messages', 'route' => route('dashboard.messaging'), 'is_route' => request()->is('dashboard/messaging*')],
        ],
    ];

    // Learners
    $menus[] = [
        'name' => 'Learners',
        'slug' => 'learners',
        'route' => route('dashboard.learners'),
        'is_route' => request()->is('dashboard/learners*'),
        'icon' => 'learners',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Student List', 'slug' => 'learners', 'route' => route('dashboard.learners'), 'is_route' => request()->is('dashboard/learners') ||
                    (request()->is('dashboard/learners/*') && !request()->is('dashboard/learners/new')),
            ],
            ['name' => 'New Student', 'slug' => 'learners.add', 'route' => route('dashboard.learners.add'), 'is_route' => request()->is('dashboard/learners/new')],
            ['name' => 'Enrolled Students', 'slug' => 'learners.enrolled', 'route' => route('dashboard.learners.enrolled'), 'is_route' => request()->is('dashboard/learners/enrolled')],
            ['name' => 'New Enroll', 'slug' => 'learners.new-enroll', 'route' => route('dashboard.learners.enrolled.enroll'), 'is_route' => request()->is('dashboard/learners/enrolled/new')],
            ['name' => 'Deleted Students', 'slug' => 'learners.deleted', 'route' => route('dashboard.learners.deleted'), 'is_route' => request()->is('dashboard/learners/deleted')],
            //['name' => 'Settings', 'slug'= > 'learners.settings', 'route' => route('dashboard.learners.settings'), 'is_route' => request()->is('dashboard/learners/settings')],
        ],
    ];

    // Trainers
    $menus[] = [
        'name' => 'Trainers',
        'slug' => 'trainers',
        'route' => route('dashboard.trainers'),
        'is_route' => request()->is('dashboard/trainers*'),
        'icon' => 'trainers',
        'has_children' => true,
        'children' => [
            [
                'name' => 'All Trainers', 'slug' => 'trainers', 'route' => route('dashboard.trainers'), 'is_route' => request()->is('dashboard/trainers') ||
                    (request()->is('dashboard/trainers/*') && !request()->is('dashboard/trainers/new')),
            ],
            ['name' => 'New Trainer', 'slug' => 'trainers.add', 'route' => route('dashboard.trainers.add'), 'is_route' => request()->is('dashboard/trainers/new*')],
            ['name' => 'Deleted Trainers', 'slug' => 'trainers.deleted', 'route' => route('dashboard.trainers.deleted'), 'is_route' => request()->is('dashboard/trainers/deleted')],
            //['name' => 'Settings', 'slug' => 'trainers.settings', 'route' => route('dashboard.trainers.settings'), 'is_route' => request()->is('dashboard/trainers/settings*')],
        ],
    ];

    // Tools & Resources
    $menus[] = [
        'name' => 'Tools & Resources',
        'slug' => 'tools-and-resources',
        'route' => route('dashboard.courses'),
        'is_route' => request()->is('dashboard/tools-and-resources*'),
        'icon' => 'tools',
        'has_children' => true,
        'children' => [
            [
                'name' => 'Course List', 'slug' => 'courses', 'route' => route('dashboard.courses'), 'is_route' => request()->is('dashboard/tools-and-resources/courses') ||
                    (request()->is('dashboard/tools-and-resources/courses/*') && !request()->is('dashboard/tools-and-resources/courses/new')),
            ],
            ['name' => 'New Course', 'slug' => 'courses.add', 'route' => route('dashboard.courses.add'), 'is_route' => request()->is('dashboard/tools-and-resources/courses/new')],
            [
                'name' => 'MCQs', 'slug' => 'mcqs', 'route' => route('dashboard.courses.mcqs'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs') || request()->is('dashboard/tools-and-resources/mcqs/*/edit'),
            ],
            ['name' => 'New MCQ Set', 'slug' => 'mcqs.add', 'route' => route('dashboard.courses.mcqs.add'), 'is_route' => request()->is('dashboard/tools-and-resources/mcqs/new')],

            ['name' => 'Topic List', 'slug' => 'topics', 'route' => route('dashboard.courses.topics'), 'is_route' => request()->is('dashboard/tools-and-resources/topics') || request()->is('dashboard/tools-and-resources/topics/*/edit')],
            ['name' => 'New Topic', 'slug' => 'topics.add', 'route' => route('dashboard.courses.topics.add'), 'is_route' => request()->is('dashboard/tools-and-resources/topics/new')],
            ['name' => 'Resource Library', 'slug' => 'course-resources', 'route' => route('dashboard.courses.resources'), 'is_route' => request()->is('dashboard/tools-and-resources/resources') || request()->is('dashboard/tools-and-resources/resources/*/edit')],
            //['name' => 'New Resource', 'slug' => 'course-resources.add', 'route' => route('dashboard.courses.resources.add'), 'is_route' => request()->is('dashboard/tools-and-resources/resources/new')],
        ],
    ];

    return $menus;
}
