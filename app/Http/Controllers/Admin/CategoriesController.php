<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends adminBaseController
{
    public function index()
    {
        $categories = Category::select('id', 'name')->orderBy('id')->paginate(20);
        $categories->page = 20;

        return view('admin.categories.index', compact('categories'));
    }

    public function batchDestroy(Request $request)
    {
        $category_ids = explode('&', $request->category_ids);
        Article::whereIn('category_id', $category_ids)->delete();
        Category::whereIn('id', $category_ids)->delete();

        return response()->json(
            [
                'code' => 0,
                'message' => '删除成功'
            ]
        );
    }

    public function update(Request $request)
    {
        //TODO 去除xss攻击和对字段的验证
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->save();

        return response()->json(
            [
                'code' => 0,
                'message' => '更新成功'
            ]
        );
    }

    public function destroy(Category $category)
    {
        Article::where('category_id', $category->id)->delete();
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

    public function store(Request $request, Category $category)
    {
        $category->name = $request->category_name;
        $category->save();

        return redirect()->route('admin.categories.index');
    }
}
