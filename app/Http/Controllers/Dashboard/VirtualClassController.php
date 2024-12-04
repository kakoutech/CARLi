<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\User;
use App\Models\VirtualClass;
use App\Models\VirtualClassAttendee;
use Illuminate\Http\Request;

class VirtualClassController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('virtual-classes.index'), 403);

        $builder = VirtualClass::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view(
            'dashboard.virtual-classes.list',
            [
                'classes' => $builder->paginate(25)
            ]
        );
    }
    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('virtual-classes.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = VirtualClass::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.virtual-classes')->with(['success' => $count . ' Items Deleted.']);
    }

    public function past(Request $request)
    {
        abort_unless(user()->canView('virtual-classes.past'), 403);

        $builder = VirtualClass::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->where('start_date', '<', now());

        return view(
            'dashboard.virtual-classes.list',
            [
                'classes' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('virtual-classes.add'), 403);

        return view('dashboard.virtual-classes.add');
    }

    public function edit(Request $request, VirtualClass $virtual_class)
    {
        abort_unless(user()->canView('virtual-classes.edit'), 403);

        return view('dashboard.virtual-classes.edit', ['class' => $virtual_class]);
    }

    public function view(Request $request, VirtualClass $virtual_class)
    {
        abort_unless(user()->canView('virtual-classes.view'), 403);

        return view('dashboard.virtual-classes.view', ['class' => $virtual_class]);
    }

    public function unenroll(Request $request, VirtualClass $virtual_class, $user_id)
    {
        abort_unless(user()->canView('virtual-classes.unenroll'), 403);

        $virtual_class_attendee = $virtual_class->attendees()->where('learner_id', '=', $user_id)->first();
        if ($virtual_class_attendee) {
            $virtual_class_attendee->delete();
        }

        return redirect()->back()->with(['success' => 'Attendee Removed']);
    }

    public function delete(Request $request, VirtualClass $virtual_class)
    {
        abort_unless(user()->canView('virtual-classes.delete'), 403);

        $virtual_class->delete();

        return redirect()->route('dashboard.virtual-classes')->with(['success' => 'Virtual Class Deleted.']);
    }
}
