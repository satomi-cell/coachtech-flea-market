<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\ExhibitionRequest;

class ExhibitionController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
       $imagePath = $request->file('image')->store('items', 'public');

       $item = Item::create([
           'user_id' => auth()->id(),
           'name' => $request->name,
           'brand' => $request->brand,
           'description' => $request->description,
           'condition' => $request->condition,
           'price' => $request->price,
           'image' => $imagePath,
       ]);

       $item->categories()->attach($request->categories);

       return redirect('/');
    }
}