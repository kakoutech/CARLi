<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('courses.index'), 403);

        $builder = Course::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view(
            'dashboard.courses.list',
            [
                'courses' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('courses.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = Course::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.courses')->with(['success' => $count . ' Items Deleted.']);
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('courses.add'), 403);

        return view('dashboard.courses.add');
    }

    public function edit(Request $request, Course $course)
    {
        abort_unless(user()->canView('courses.edit'), 403);

        return view('dashboard.courses.edit', ['course' => $course]);
    }

    public function view(Request $request, Course $course)
    {
        abort_unless(user()->canView('courses.view'), 403);

        return view('dashboard.courses.view', ['course' => $course]);
    }

    public function removeEnroll(Request $request, Course $course, CourseEnroll $course_enroll)
    {
        abort_unless(user()->canView('courses.remove-enroll'), 403);

        $course_enroll->delete();

        return redirect()->route('dashboard.courses.view', [$course->id])->with(['success' => 'Leaner Removed.']);
    }

    public function delete(Request $request, Course $course)
    {
        abort_unless(user()->canView('courses.delete'), 403);

        $course->delete();

        return redirect()->route('dashboard.courses')->with(['success' => 'Course Deleted.']);
    }
}
