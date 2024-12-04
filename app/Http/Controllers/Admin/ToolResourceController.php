<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolResourceArticle;
use Illuminate\Http\Request;

class ToolResourceController extends Controller
{
    public function index(Request $request)
    {
        $builder = ToolResourceArticle::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('content', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        $builder->orderBy('created_at', 'DESC');

        $articles = $builder->paginate(20);

        return view(
            'admin.tools-and-resources.list',
            [
                'articles' => $articles
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.tools-and-resources.add');
    }

    public function edit(Request $request, ToolResourceArticle $tool_resource_article)
    {
        return view('admin.tools-and-resources.edit', ['article' => $tool_resource_article]);
    }

    public function delete(Request $request, ToolResourceArticle $tool_resource_article)
    {
        $tool_resource_article->delete();

        return redirect()->route('admin.tools-and-resources')->with(['success' => 'Tool Resource Article Deleted.']);
    }
}
