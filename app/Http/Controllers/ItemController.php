<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function check(Request $request)
    {
        $exists = Item::where('name', $request->input('name'))->exists();
        return response()->json(['exists' => $exists]);
    }
}
