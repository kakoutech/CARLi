<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CourseTopic;
use Illuminate\Http\Request;

class CourseTopicController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('courses.topics.index'), 403);

        $builder = CourseTopic::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->orderBy('order', 'ASC');

        return view(
            'dashboard.course-topics.list',
            [
                'topics' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('courses.topics.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = CourseTopic::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.courses.topics')->with(['success' => $count . ' Items Deleted.']);
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('courses.topics.add'), 403);

        return view('dashboard.course-topics.add');
    }

    public function edit(Request $request, CourseTopic $course_topic)
    {
        abort_unless(user()->canView('courses.topics.edit'), 403);

        return view('dashboard.course-topics.edit', ['topic' => $course_topic]);
    }

    public function delete(Request $request, CourseTopic $course_topic)
    {
        abort_unless(user()->canView('courses.topics.delete'), 403);

        $course_topic->delete();

        return redirect()->route('dashboard.courses.topics')->with(['success' => 'Topic Deleted.']);
    }
}
