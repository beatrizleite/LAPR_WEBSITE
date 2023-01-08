<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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

    public function deleteCat()
    {
        
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
        return redirect('/')->with('status', 'Category edited successfully!');
    }
}
