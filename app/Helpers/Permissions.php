<?php

use App\Models\User;

function canUserView(User $user, $action)
{
    $action_split = explode('.', $action);
    $group = isset($action_split[0]) ? $action_split[0] : null;
    $subaction = isset($action_split[1]) ? $action_split[1] : null;

    if ($group == 'trainers') {
        if (!$user->isSuperAdmin() && !$user->isEmployer()) {
            return false;
        }
    }

    if ($group == 'employers') {
        if (!$user->isSuperAdmin()) {
            return false;
        }
    }

    // check the DB for an action override
    $permission_check = $user->permissions()->where('action', '=', $action)->first();
    if ($permission_check) {
        return (bool) $permission_check->permission;
    }

    $role = $user->account_type;

    if ($role == 'trainer') {
        $role = 'trainers';
    }

    if ($role == 'employer') {
        $role = 'employers';
    }

    if ($role == 'learner') {
        $role = 'learners';
    }

    $permissions = getPermissionData();

    //dd($user->account_type, $role, $action, $permissions[$action]);

    if (!isset($permissions[$action]) || !isset($permissions[$action][$role])) {
        return false;
    }

    return $permissions[$action][$role];
}

function getGroupedPermissionData(User $user)
{
    $datas = getPermissionData();

    foreach ($datas as &$item) {
        $item = true;
    }

    foreach ($user->permissions as $permission) {
        $datas[$permission->action] = (bool) $permission->permission;
    }

    $new_datas = [];

    foreach ($datas as $key => $value) {
        $_key = explode('.', $key);
        $key = str_replace('.', '__', $key);
        @$new_datas[$_key[0]][$key] = $value;
    }

    return $new_datas;
}

function mergeUserPermissions(User $user)
{
    $permissions = getPermissionData();

    foreach ($user->permission as $permission) {
        $permissions[$permission->action] = (bool) $permission->permission;
    }

    return $permissions;
}

function getPermissionData()
{
    return [
        'super-admins.index' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.deleted' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.add' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.edit' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.view' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.settings' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.delete' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'super-admins.restore' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],

        'employers.index' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.deleted' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.add' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.edit' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.view' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.settings' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.delete' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],
        'employers.restore' => ['admin' => true, 'employers' => false, 'trainers' => false, 'learners' => false],

        'trainers.index' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.deleted' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.add' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.edit' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.view' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.settings' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.delete' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'trainers.restore' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],

        'learners.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.deleted' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.settings' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.restore' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.enrolled' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.new-enroll' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'learners.view-certificate' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'certificates.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'certificates.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'certificates.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'certificates.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'courses.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.remove-enroll' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.mcqs.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.mcqs.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.mcqs.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.mcqs.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.mcqs.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.resources.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.resources.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.resources.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.resources.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.topics.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.topics.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.topics.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'courses.topics.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.history' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.settings' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.level' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.level.remove-from-user' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'gamification.badges.level.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'cms.index' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'cms.deleted' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'cms.add' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'cms.edit' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'cms.delete' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],
        'cms.restore' => ['admin' => true, 'employers' => true, 'trainers' => false, 'learners' => false],

        'reflective-journal.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'reflective-journal.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'reflective-journal.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'reflective-journal.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'strategy-tools.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.resources.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.resources.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.resources.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.resources.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.topics.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.topics.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.topics.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'strategy-tools.topics.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'virtual-classes.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.past' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.unenroll' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'virtual-classes.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],

        'assessments.index' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'assessments.add' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'assessments.edit' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'assessments.view' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
        'assessments.delete' => ['admin' => true, 'employers' => true, 'trainers' => true, 'learners' => false],
    ];
}
