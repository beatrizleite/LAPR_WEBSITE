<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Nette\Utils\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class SellerController extends Controller
{
    public function allItems()
    {
        $id = Auth::user()->id;
        $allitems = Item::where('vendor', '=', $id)->paginate(6);
        $cats = Category::all();
        return view('seller.allItems', [
            'items' => $allitems,
            'cats' => $cats
        ]);
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('seller/allItems')->with('status', 'Item deleted successfully!');
    }

    public function editItem($id)
    {
        $item = Item::find($id);
        $cats = Category::all();
        return view('seller.editItem', compact('item', 'cats'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->category = $request->input('category');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->update();
        return redirect('seller/allItems')->with('status', 'Item edited successfully!');
    }

    public function addItem(Request $request)
    {
        $id = Auth::user()->id;

        $item = new Item();

        if ($request->file('image') != null) {
            $imgName = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $imgName, 'public');
            $img = Image::make($path)->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            });
            $item->image = $imgName;
        }
        
        $item->vendor = $id;
        $item->name = $request->input('name');
        $item->category = $request->input('cat');
        $item->price = $request->input('price');
        $item->description = $request->input('description');

        $item->save();

        return redirect()->back()->with('status', 'Item added successfully!');

    }
}
