<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\StrategyToolArticle;
use App\Models\User;
use App\Models\UserSession;
use App\Notifications\LearnerAssignedToCourseNotification;
use Illuminate\Http\Request;

/**
 * Dashboard Controller
 *
 * @author Benjamin Hall <ben@conobe.co.uk>
 */
class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $enroll = CourseEnroll::query()->first();

        auth()->user()->notify(new LearnerAssignedToCourseNotification($enroll));

        $total_logged_in_time = null;
        $total_courses = null;
        $total_articles = null;
        $total_learners = null;
        $total_trainers = null;
        $total_employers = null;

        if (auth()->user()->isSuperAdmin()) {
            $total_learners = User::query()->learners()->count();
            $total_trainers = User::query()->trainers()->count();
            $total_employers = User::query()->employers()->count();
            $total_courses = Course::query()->count();
            $total_articles = StrategyToolArticle::query()->count();
            $total_logged_in_time = UserSession::sum('minutes');
        }

        if (auth()->user()->isEmployer()) {
            $employer_id = auth()->user()->id;
            $total_learners = User::query()->learners()->whereHas('trainer', function ($query) use ($employer_id) {
                return $query->where('employer_id', '=', $employer_id);
            })->count();
            $total_trainers = User::query()->trainers()->where('employer_id', '=', $employer_id)->count();
            $total_courses = Course::query()->whereHas('trainer', function ($query) use ($employer_id) {
                return $query->where('employer_id', '=', $employer_id);
            })->count();
            $total_articles = StrategyToolArticle::query()->count();
            $total_logged_in_time = UserSession::whereHas('user', function ($query) use ($employer_id) {
                return $query->whereHas('trainer', function ($query) use ($employer_id) {
                    return $query->where('employer_id', '=', $employer_id);
                });
            })->sum('minutes');
        }

        if (auth()->user()->isTrainer()) {
            $trainer_id = auth()->user()->id;
            $total_learners = User::query()->learners()->where('trainer_id', '=', $trainer_id)->count();
            $total_logged_in_time = UserSession::whereHas('user', function ($query) use ($trainer_id) {
                return $query->where('trainer_id', '=', $trainer_id);
            })->sum('minutes');
            $total_courses = Course::query()->where('trainer_id', '=', $trainer_id)->count();
        }

        if (auth()->user()->isEmployer()) {
        }

        return view(
            'dashboard.dashboard',
            [
                'total_learners' => $total_learners,
                'total_trainers' => $total_trainers,
                'total_employers' => $total_employers,
                'total_articles' => $total_articles,
                'total_courses' => $total_courses,
                'total_logged_in_time' => $total_logged_in_time,
                'notifications' => auth()->user()->notifications()->latest()->limit(5)->get(),
                'messages' => auth()->user()->getUnreadMessages(),
            ]
        );
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        return view('dashboard.profile', [
            'user' => $user
        ]);
    }
}
