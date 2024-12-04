<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ResourceController;
use App\Http\Controllers\Dashboard\PageManagementController;
use App\Http\Controllers\Dashboard\SuperAdminController;
use App\Http\Controllers\Dashboard\TrainerController;
use App\Http\Controllers\Dashboard\EmployerController;
use App\Http\Controllers\Dashboard\LearnerController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\CourseTopicController;
use App\Http\Controllers\Dashboard\CourseResourceController;
use App\Http\Controllers\Dashboard\VirtualClassController;
use App\Http\Controllers\Dashboard\GamificationController;
use App\Http\Controllers\Dashboard\ReflectiveJournalController;
use App\Http\Controllers\Dashboard\StrategyToolController;
use App\Http\Controllers\Dashboard\StrategyToolTopicController;
use App\Http\Controllers\Dashboard\StrategyToolResourceController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\CertificateController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\CourseMultipleChoiceQuestionController;
use App\Http\Controllers\Dashboard\AssessmentController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/artisan/clear', function () {
    Artisan::call('config:clear');
});
Route::get('/artisan/migrate', function () {
    Artisan::call('migrate');
});

Route::redirect('/', '/dashboard', 302)->name('home');

//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'checkAccountType:learner|trainer|employer'])->group(function () {
//    Route::get('/', [HomepageController::class, 'homepage'])->name('home');
//    Route::get('/welcome', [HomepageController::class, 'welcome'])->name('welcome');
//    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
//    Route::get('/tools-and-resources', [ToolResourceController::class, 'index'])->name('tools-and-resources');
//    Route::get('/tools-and-resources/new', [ToolResourceController::class, 'add'])->name('tools-and-resources.add');
//    Route::get('/tools-and-resources/{tool_resource_article:slug}', [ToolResourceController::class, 'view'])->name('tools-and-resources.view');
//    Route::get('/tools-and-resources/{tool_resource_article:slug}/edit', [ToolResourceController::class, 'edit'])->name('tools-and-resources.edit');
//});

Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'checkAccountType:admin|learner|trainer|employer'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'list'])->name('dashboard.notifications');

    // Messaging
    Route::get('/messaging', [MessageController::class, 'list'])->name('dashboard.messaging');

    // Resource
    Route::get('/resource/{resource:id}', [ResourceController::class, 'view'])->name('dashboard.resource');

    // Learner Pages
    Route::get('/my-courses', [ProfileController::class, 'courses'])->name('dashboard.my-courses');
    Route::get('/my-courses/{course:id}', [ProfileController::class, 'viewCourse'])->name('dashboard.my-courses.view');
    Route::get('/my-competency-tests', [ProfileController::class, 'mcqs'])->name('dashboard.my-competency-tests');
    Route::get('/my-competency-tests/{course:id}', [ProfileController::class, 'viewMcq'])->name('dashboard.my-competency-tests.view');
    Route::get('/my-classes', [ProfileController::class, 'classes'])->name('dashboard.my-classes');
    Route::get('/my-classes/{course:id}', [ProfileController::class, 'viewClass'])->name('dashboard.my-classes.view');
    Route::get('/my-certificates', [ProfileController::class, 'certificates'])->name('dashboard.my-certificates');
    Route::get('/my-certificates/{user_certificate:id}', [ProfileController::class, 'viewCertificate'])->name('dashboard.my-certificates.view');
    Route::get('/my-reflective-journal', [ProfileController::class, 'reflectiveJournal'])->name('dashboard.my-reflective-journal');
    Route::get('/my-reflective-journal/new', [ProfileController::class, 'newReflectiveJournal'])->name('dashboard.my-reflective-journal.new');
    Route::get('/my-reflective-journal/{reflective_journal_entry:id}', [ProfileController::class, 'viewReflectiveJournal'])->name('dashboard.my-reflective-journal.view');
    Route::get('/my-badges', [ProfileController::class, 'badges'])->name('dashboard.my-badges');

    Route::get('/assessment-hub', [ProfileController::class, 'assessmentHub'])->name('dashboard.assessment-hub');
    Route::get('/assessment-hub/assessments', [ProfileController::class, 'assessments'])->name('dashboard.assessment-hub.assessments');
    Route::get('/assessment-hub/assessments/{assessment:id}', [ProfileController::class, 'takeAssessment'])->name('dashboard.assessment-hub.view');
    Route::get('/assessment-hub/assessments/{assessment:id}/{assessment_response:id}', [ProfileController::class, 'reviewAssessment'])->name('dashboard.assessment-hub.view.marking');

    Route::get('/my-strategy-tools', [StrategyToolController::class, 'learnerList'])->name('dashboard.strategy-tools');
    Route::get('/my-strategy-tools/{strategy_tool_article:slug}', [StrategyToolController::class, 'learnerView'])->name('dashboard.strategy-tools.view');

    // Super Admin Users
    Route::get('/super-admins', [SuperAdminController::class, 'index'])->name('dashboard.super-admins');
    Route::get('/super-admins/settings', [SuperAdminController::class, 'settings'])->name('dashboard.super-admins.settings');
    Route::get('/super-admins/deleted', [SuperAdminController::class, 'deleted'])->name('dashboard.super-admins.deleted');
    Route::get('/super-admins/new', [SuperAdminController::class, 'add'])->name('dashboard.super-admins.add');
    Route::delete('/super-admins/mass-delete', [SuperAdminController::class, 'massDelete'])->name('dashboard.super-admins.mass-delete');
    Route::get('/super-admins/{user:id}', [SuperAdminController::class, 'view'])->name('dashboard.super-admins.view');
    Route::get('/super-admins/{user:id}/edit', [SuperAdminController::class, 'edit'])->name('dashboard.super-admins.edit');
    Route::post('/super-admins/{user:id}/restore', [SuperAdminController::class, 'restore'])->name('dashboard.super-admins.restore')->withTrashed();
    Route::delete('/super-admins/{user:id}/delete', [SuperAdminController::class, 'delete'])->name('dashboard.super-admins.delete');

    // Trainer
    Route::get('/trainers', [TrainerController::class, 'index'])->name('dashboard.trainers');
    Route::get('/trainers/settings', [TrainerController::class, 'settings'])->name('dashboard.trainers.settings');
    Route::get('/trainers/deleted', [TrainerController::class, 'deleted'])->name('dashboard.trainers.deleted');
    Route::get('/trainers/new', [TrainerController::class, 'add'])->name('dashboard.trainers.add');
    Route::delete('/trainers/mass-delete', [TrainerController::class, 'massDelete'])->name('dashboard.trainers.mass-delete');
    Route::get('/trainers/{user:id}', [TrainerController::class, 'view'])->name('dashboard.trainers.view');
    Route::get('/trainers/{user:id}/edit', [TrainerController::class, 'edit'])->name('dashboard.trainers.edit');
    Route::post('/trainers/{user:id}/restore', [TrainerController::class, 'restore'])->name('dashboard.trainers.restore')->withTrashed();
    Route::delete('/trainers/{user:id}/delete', [TrainerController::class, 'delete'])->name('dashboard.trainers.delete');

    // Employer
    Route::get('/employers', [EmployerController::class, 'index'])->name('dashboard.employers');
    Route::get('/employers/settings', [EmployerController::class, 'settings'])->name('dashboard.employers.settings');
    Route::get('/employers/deleted', [EmployerController::class, 'deleted'])->name('dashboard.employers.deleted');
    Route::get('/employers/new', [EmployerController::class, 'add'])->name('dashboard.employers.add');
    Route::delete('/employers/mass-delete', [EmployerController::class, 'massDelete'])->name('dashboard.employers.mass-delete');
    Route::get('/employers/{user:id}', [EmployerController::class, 'view'])->name('dashboard.employers.view');
    Route::get('/employers/{user:id}/edit', [EmployerController::class, 'edit'])->name('dashboard.employers.edit');
    Route::post('/employers/{user:id}/restore', [EmployerController::class, 'restore'])->name('dashboard.employers.restore')->withTrashed();
    Route::delete('/employers/{user:id}/delete', [EmployerController::class, 'delete'])->name('dashboard.employers.delete');

    // Learner
    Route::get('/learners', [LearnerController::class, 'index'])->name('dashboard.learners');
    Route::get('/learners/settings', [LearnerController::class, 'settings'])->name('dashboard.learners.settings');
    Route::get('/learners/enrolled', [LearnerController::class, 'enrolled'])->name('dashboard.learners.enrolled');
    Route::get('/learners/enrolled/new', [LearnerController::class, 'newEnroll'])->name('dashboard.learners.enrolled.enroll');
    Route::get('/learners/deleted', [LearnerController::class, 'deleted'])->name('dashboard.learners.deleted');
    Route::get('/learners/new', [LearnerController::class, 'add'])->name('dashboard.learners.add');
    Route::delete('/learners/mass-delete', [LearnerController::class, 'massDelete'])->name('dashboard.learners.mass-delete');
    Route::get('/learners/{user:id}', [LearnerController::class, 'view'])->name('dashboard.learners.view');
    Route::get('/learners/{user:id}/journals/{reflective_journal_entry:id}', [LearnerController::class, 'viewJournalResponse'])->name('dashboard.learners.view.journals.view');
    Route::get('/learners/{user:id}/mcqs/{user_mcq:id}', [LearnerController::class, 'viewMcqResult'])->name('dashboard.learners.view.mcqs.view');
    Route::get('/learners/{user:id}/assessments/{assessment_response:id}', [LearnerController::class, 'viewAssessmentResult'])->name('dashboard.learners.view.assessment.view');
    Route::delete('/learners/{user:id}/mcqs/{user_mcq:id}/delete', [LearnerController::class, 'cancelMcq'])->name('dashboard.learners.view.mcqs.cancel');
    Route::get('/learners/{user:id}/edit', [LearnerController::class, 'edit'])->name('dashboard.learners.edit');
    Route::get('/learners/{user:id}/certificates/{user_certificate:id}/view', [LearnerController::class, 'viewCertificate'])->name('dashboard.learners.view.certificate');
    Route::post('/learners/{user:id}/restore', [LearnerController::class, 'restore'])->name('dashboard.learners.restore')->withTrashed();
    Route::delete('/learners/{user:id}/delete', [LearnerController::class, 'delete'])->name('dashboard.learners.delete');

    // CMS
    Route::get('/cms', [PageManagementController::class, 'index'])->name('dashboard.cms');
    Route::get('/cms/new', [PageManagementController::class, 'add'])->name('dashboard.cms.add');
    Route::get('/cms/deleted', [PageManagementController::class, 'deleted'])->name('dashboard.cms.deleted');
    Route::delete('/cms/mass-delete', [PageManagementController::class, 'massDelete'])->name('dashboard.cms.mass-delete');
    Route::get('/cms/{page:id}/edit', [PageManagementController::class, 'edit'])->name('dashboard.cms.edit');
    Route::post('/cms/{page:id}/restore', [PageManagementController::class, 'restore'])->name('dashboard.cms.restore')->withTrashed();
    Route::delete('/cms/{page:id}/delete', [PageManagementController::class, 'delete'])->name('dashboard.cms.delete');

    // Courses
    Route::redirect('/tools-and-resources', '/tools-and-resources/courses', 302);
    Route::get('/tools-and-resources/courses', [CourseController::class, 'index'])->name('dashboard.courses');
    Route::get('/tools-and-resources/courses/new', [CourseController::class, 'add'])->name('dashboard.courses.add');
    Route::delete('/tools-and-resources/courses/mass-delete', [CourseController::class, 'massDelete'])->name('dashboard.courses.mass-delete');
    Route::get('/tools-and-resources/courses/{course:id}', [CourseController::class, 'view'])->name('dashboard.courses.view');
    Route::post('/tools-and-resources/courses/{course:id}/enrolled/{course_enroll:id}/remove', [CourseController::class, 'removeEnroll'])->name('dashboard.courses.view.enrolled.remove');
    Route::get('/tools-and-resources/courses/{course:id}/edit', [CourseController::class, 'edit'])->name('dashboard.courses.edit');
    Route::delete('/tools-and-resources/courses/{course:id}/delete', [CourseController::class, 'delete'])->name('dashboard.courses.delete');

    // Course MCQs
    Route::get('/tools-and-resources/mcqs', [CourseMultipleChoiceQuestionController::class, 'index'])->name('dashboard.courses.mcqs');
    Route::get('/tools-and-resources/mcqs/new', [CourseMultipleChoiceQuestionController::class, 'add'])->name('dashboard.courses.mcqs.add');
    Route::delete('/tools-and-resources/mcqs/mass-delete', [CourseMultipleChoiceQuestionController::class, 'massDelete'])->name('dashboard.courses.mcqs.mass-delete');
    Route::get('/tools-and-resources/mcqs/{multiple_choice_question_set:id}', [CourseMultipleChoiceQuestionController::class, 'view'])->name('dashboard.courses.mcqs.view');
    Route::get('/tools-and-resources/mcqs/{multiple_choice_question_set:id}/edit', [CourseMultipleChoiceQuestionController::class, 'edit'])->name('dashboard.courses.mcqs.edit');
    Route::delete('/tools-and-resources/mcqs/{multiple_choice_question_set:id}/delete', [CourseMultipleChoiceQuestionController::class, 'delete'])->name('dashboard.courses.mcqs.delete');

    // Course Assessments
    Route::get('/assessments', [AssessmentController::class, 'index'])->name('dashboard.assessments');
    Route::get('/assessments/new', [AssessmentController::class, 'add'])->name('dashboard.assessments.add');
    Route::delete('/assessments/mass-delete', [AssessmentController::class, 'massDelete'])->name('dashboard.assessments.mass-delete');
    Route::get('/assessments/{assessment:id}', [AssessmentController::class, 'view'])->name('dashboard.assessments.view');
    Route::get('/assessments/{assessment:id}/edit', [AssessmentController::class, 'edit'])->name('dashboard.assessments.edit');
    Route::delete('/assessments/{assessment:id}/delete', [AssessmentController::class, 'delete'])->name('dashboard.assessments.delete');

    // Course Topics
    Route::get('/tools-and-resources/topics', [CourseTopicController::class, 'index'])->name('dashboard.courses.topics');
    Route::get('/tools-and-resources/topics/new', [CourseTopicController::class, 'add'])->name('dashboard.courses.topics.add');
    Route::delete('/tools-and-resources/topics/mass-delete', [CourseTopicController::class, 'massDelete'])->name('dashboard.courses.topics.mass-delete');
    Route::get('/tools-and-resources/topics/{course_topic:id}/edit', [CourseTopicController::class, 'edit'])->name('dashboard.courses.topics.edit');
    Route::delete('/tools-and-resources/topics/{course_topic:id}/delete', [CourseTopicController::class, 'delete'])->name('dashboard.courses.topics.delete');

    // Course Resources
    Route::get('/tools-and-resources/resources', [CourseResourceController::class, 'index'])->name('dashboard.courses.resources');
    Route::get('/tools-and-resources/resources/new', [CourseResourceController::class, 'add'])->name('dashboard.courses.resources.add');
    Route::delete('/tools-and-resources/resources/mass-delete', [CourseResourceController::class, 'massDelete'])->name('dashboard.courses.resources.mass-delete');
    Route::get('/tools-and-resources/resources/{course_topic:id}/edit', [CourseResourceController::class, 'edit'])->name('dashboard.courses.resources.edit');
    Route::delete('/tools-and-resources/resources/{course_topic:id}/delete', [CourseResourceController::class, 'delete'])->name('dashboard.courses.resources.delete');

    // Virtual Class
    Route::get('/virtual-classes', [VirtualClassController::class, 'index'])->name('dashboard.virtual-classes');
    Route::get('/virtual-classes/past', [VirtualClassController::class, 'past'])->name('dashboard.virtual-classes.past');
    Route::get('/virtual-classes/new', [VirtualClassController::class, 'add'])->name('dashboard.virtual-classes.add');
    Route::delete('/virtual-classes/mass-delete', [VirtualClassController::class, 'massDelete'])->name('dashboard.virtual-classes.mass-delete');
    Route::get('/virtual-classes/{virtual_class:id}', [VirtualClassController::class, 'view'])->name('dashboard.virtual-classes.view');
    Route::delete('/virtual-classes/{virtual_class:id}/unenroll/{user_id}', [VirtualClassController::class, 'unenroll'])->name('dashboard.virtual-classes.unenroll');
    Route::get('/virtual-classes/{virtual_class:id}/edit', [VirtualClassController::class, 'edit'])->name('dashboard.virtual-classes.edit');
    Route::delete('/virtual-classes/{virtual:id}/delete', [VirtualClassController::class, 'delete'])->name('dashboard.virtual-classes.delete');

    // Gamification
    Route::get('/gamification', [GamificationController::class, 'index'])->name('dashboard.gamification');
    Route::get('/gamification/history', [GamificationController::class, 'history'])->name('dashboard.gamification.history');
    Route::get('/gamification/badges', [GamificationController::class, 'badges'])->name('dashboard.gamification.badges');
    Route::get('/gamification/badges/{badge:id}/new', [GamificationController::class, 'addBadgeLevel'])->name('dashboard.gamification.badges.add');
    Route::get('/gamification/badges/{badge:id}/{badge_level:id}', [GamificationController::class, 'badgeLevel'])->name('dashboard.gamification.badges.levels');
    Route::get('/gamification/badges/{badge:id}/{badge_level:id}/edit', [GamificationController::class, 'editBadgeLevel'])->name('dashboard.gamification.badges.levels.edit');
    Route::delete('/gamification/badges/{badge:id}/{badge_level:id}/{user_badge:id}', [GamificationController::class, 'removeBadgeLevelFromUser'])->name('dashboard.gamification.badges.levels.user.remove');
    Route::delete('/gamification/badges/{badge:id}/{badge_level:id}', [GamificationController::class, 'deleteBadgeLevel'])->name('dashboard.gamification.badges.levels.delete');
    Route::get('/gamification/settings', [GamificationController::class, 'settings'])->name('dashboard.gamification.settings');
    Route::post('/gamification/settings', [GamificationController::class, 'handleSettings'])->name('dashboard.gamification.settings');

    // Certificate
    Route::get('/certificates', [CertificateController::class, 'index'])->name('dashboard.certificates');
    Route::get('/certificates/new', [CertificateController::class, 'add'])->name('dashboard.certificates.add');
    Route::get('/certificates/award', [CertificateController::class, 'award'])->name('dashboard.certificates.award');
    Route::delete('/certificates/mass-delete', [CertificateController::class, 'massDelete'])->name('dashboard.certificates.mass-delete');
    Route::get('/certificates/{certificate:id}', [CertificateController::class, 'edit'])->name('dashboard.certificates.edit');
    Route::delete('/certificates/{certificate:id}/delete', [CertificateController::class, 'delete'])->name('dashboard.certificates.delete');

    // Reflective Journal
    Route::get('/reflective-journal', [ReflectiveJournalController::class, 'index'])->name('dashboard.reflective-journal');
    Route::get('/reflective-journal/new', [ReflectiveJournalController::class, 'add'])->name('dashboard.reflective-journal.add');
    Route::delete('/reflective-journal/mass-delete', [ReflectiveJournalController::class, 'massDelete'])->name('dashboard.reflective-journal.mass-delete');
    Route::get('/reflective-journal/audio/{reflective_journal_entry:id}', [ReflectiveJournalController::class, 'viewAudio'])->name('dashboard.reflective-journal.audio');
    Route::get('/reflective-journal/file/{reflective_journal_entry:id}', [ReflectiveJournalController::class, 'viewFile'])->name('dashboard.reflective-journal.file');
    Route::get('/reflective-journal/{reflective_journal_step}/edit', [ReflectiveJournalController::class, 'edit'])->name('dashboard.reflective-journal.edit');
    Route::delete('/reflective-journal/{reflective_journal_step}/delete', [ReflectiveJournalController::class, 'delete'])->name('dashboard.reflective-journal.delete');

    // Strategy Tools and Resources
    Route::redirect('/strategy-tools', '/strategy-tools/articles', 302);
    Route::get('/strategy-tools/articles', [StrategyToolController::class, 'index'])->name('dashboard.strategy-tools.articles');
    Route::get('/strategy-tools/articles/new', [StrategyToolController::class, 'add'])->name('dashboard.strategy-tools.articles.add');
    Route::delete('/strategy-tools/articles/mass-delete', [StrategyToolController::class, 'massDelete'])->name('dashboard.strategy-tools.articles.mass-delete');
    Route::get('/strategy-tools/articles/{strategy_tool_article}', [StrategyToolController::class, 'view'])->name('dashboard.strategy-tools.articles.view');
    Route::get('/strategy-tools/articles/{strategy_tool_article}/edit', [StrategyToolController::class, 'edit'])->name('dashboard.strategy-tools.articles.edit');
    Route::delete('/strategy-tools/articles/{strategy_tool_article}/delete', [StrategyToolController::class, 'delete'])->name('dashboard.strategy-tools.articles.delete');

    // Strategy Tool Topics
    Route::get('/strategy-tools/topics', [StrategyToolTopicController::class, 'index'])->name('dashboard.strategy-tools.topics');
    Route::get('/strategy-tools/topics/new', [StrategyToolTopicController::class, 'add'])->name('dashboard.strategy-tools.topics.add');
    Route::delete('/strategy-tools/topics/mass-delete', [StrategyToolTopicController::class, 'massDelete'])->name('dashboard.strategy-tools.topics.mass-delete');
    Route::get('/strategy-tools/topics/{strategy_tool_topic}/edit', [StrategyToolTopicController::class, 'edit'])->name('dashboard.strategy-tools.topics.edit');
    Route::delete('/strategy-tools/topics/{strategy_tool_topic}/delete', [StrategyToolTopicController::class, 'delete'])->name('dashboard.strategy-tools.topics.delete');

    // Strategy Tool Resources
    Route::get('/strategy-tools/resources', [StrategyToolResourceController::class, 'index'])->name('dashboard.strategy-tools.resources');
    Route::get('/strategy-tools/resources/new', [StrategyToolResourceController::class, 'add'])->name('dashboard.strategy-tools.resources.add');
    Route::delete('/strategy-tools/resources/mass-delete', [StrategyToolResourceController::class, 'massDelete'])->name('dashboard.strategy-tools.resources.mass-delete');
    Route::get('/strategy-tools/resources/{course_topic:id}/edit', [StrategyToolResourceController::class, 'edit'])->name('dashboard.strategy-tools.resources.edit');
    Route::delete('/strategy-tools/resources/{course_topic:id}/delete', [StrategyToolResourceController::class, 'delete'])->name('dashboard.strategy-tools.resources.delete');
});

Route::get('/{page_stub_1}/{page_stub_2}/{page_stub_3}/{page_stub_4}', [PageController::class, 'view'])->name('page');
Route::get('/{page_stub_1}/{page_stub_2}/{page_stub_3}', [PageController::class, 'view'])->name('page');
Route::get('/{page_stub_1}/{page_stub_2}', [PageController::class, 'view'])->name('page');
Route::get('/{page_stub_1}', [PageController::class, 'view'])->name('page');




//login
//register - tabbed (learner, employer, trainer) - email notification
//forgot-password
//profile (update name, email, etc)