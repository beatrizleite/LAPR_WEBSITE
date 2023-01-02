<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    function detail($id)
    {
        $data = Item::find($id);
        return view('detail', ['item' => $data]);
    }

    function search(Request $request)
    {
        $data = Item::where('name', 'ilike', '%' . $request->input('query') . '%')->get();
        return view('search', ['items' => $data]);
    }
}