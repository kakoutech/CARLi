<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;

/**
 * Notification Controller
 * 
 * @author Benjamin Hall <ben@conobe.co.uk>
 */
class NotificationController extends Controller
{
    public function list(Request $request)
    {
        $builder = auth()->user()->notifications();

        $builder->latest();

        return view(
            'dashboard.notifications.list',
            [
                'notifications' => $builder->paginate(10)
            ]
        );
    }
}
