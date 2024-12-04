<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('certificates.index'), 403);

        $builder = Certificate::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view(
            'dashboard.certificates.list',
            [
                'certificates' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('certificates.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = Certificate::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.certificates')->with(['success' => $count . ' Items Deleted.']);
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('certificates.add'), 403);

        return view('dashboard.certificates.add');
    }

    public function edit(Request $request, Certificate $certificate)
    {
        abort_unless(user()->canView('certificates.edit'), 403);

        return view('dashboard.certificates.edit', [
            'certificate' => $certificate
        ]);
    }

    public function delete(Request $request, Certificate $certificate)
    {
        abort_unless(user()->canView('certificates.delete'), 403);

        $certificate->delete();

        return redirect()
            ->route('dashboard.certificates')
            ->with([
                'success' => 'Certificate Deleted.'
            ]);
    }
}
