<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\UpdateCateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCate()
    {
        $data['catelist'] = Category::all();
        return view('backend.category', $data);
    }

    public function postCate(AddCateRequest $request)
    {
        $category = new Category;
        $category->cate_name = $request->name;
        $category->cate_slug = str_slug($request->name);
        $category->save();

        return redirect('admin/category');
    }

    public function getEditCate($id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('backend.editcategory', $data);
    }

    public function updateCate(UpdateCateRequest $request, $id)
    {
        $category = Category::findOrFail($id)->update([
            'cate_name' => $request->name,
            'cate_slug' => str_slug($request->name)
        ]);

        return redirect('admin/category');
    }

    public function getDeleteCate($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('admin/category');
    }
}
