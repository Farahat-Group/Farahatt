<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index() {
        return view('categories.index' , [
            'categories' => Category::all()
        ]);

    }
    public function edit($id) {
        return view('categories.edit' , [
            'category' => Category::find($id)
        ]);
    }

    public function update(Request $request , $id , FlasherInterface $flasher){
        $request->validate([
            'title' => ['required' , Rule::unique('categories' , 'title')->ignore($id)],
            'description' => 'required',
        ]);
        $category= Category::find($id);
        $category->title = $request['title'];
        $category->description = $request['description'];
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/images/categories/profile'), $new_name);
            $category->image = $new_name;
        }
        $category->save();
        $flasher->addSuccess('Category Updated !');
        return redirect()->back();
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request, FlasherInterface $flasher)
    {

        $request->validate([
            'title' => ['required', Rule::unique('categories', 'title')],
            'description' => 'required',
        ]);
        $category = new Category;
        $category->title = $request->title;
        $category->description = $request->description;

        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/images/categories/profile'), $new_name);
            $category->image = $new_name;
        }
        $category->save();
        $flasher->addSuccess('Category Created');
        return redirect()->route('categories.index');
    }

    public function delete($id,  FlasherInterface $flasher)
    {
        Category::find($id)->delete();
        $flasher->addDeleted('Category');
        return redirect()->back();
    }
}
