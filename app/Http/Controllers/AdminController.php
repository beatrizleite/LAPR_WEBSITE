<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function allUsers()
    {
        $id = Auth::user()->id;
        $allusers = User::where('id', '!=', $id)->orderBy('id', 'asc')->paginate(6);
        return view('allUsers', [
            'users' => $allusers
        ]);
    }

    public function allCategories()
    {
        return view('allCategories', [
            'cats' => Category::orderBy('id', 'asc')->paginate(6)
        ]);
    }
    
    public function allItems()
    {
        return view('allItems', [
            'items' => Item::orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    public function addCat(Request $request)
    {
        $category = new Category();
        $category->category = $request->input('category');
        $category->save();
        return redirect()->back()->with('status', 'Category added successfully!');
    }

    public function deleteCat($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/allCategories')->with('status', 'Category deleted successfully!');
    }

    public function editCat($id)
    {
        $cat = Category::find($id);
        return view('editCat', compact('cat'));
    }

    public function updateCat(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category = $request->input('category');
        $category->update();
        return redirect('admin/allCategories')->with('status', 'Category edited successfully!');
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('admin/allItems')->with('status', 'Category deleted successfully!');
    }

    public function editItem($id)
    {
        $item = Item::find($id);
        $cats = Category::all();
        return view('editItem', compact('item', 'cats'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->category = $request->input('category');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->update();
        return redirect('admin/allItems')->with('status', 'Category edited successfully!');
    }

}
