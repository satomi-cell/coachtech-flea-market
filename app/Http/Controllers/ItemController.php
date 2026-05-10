<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
  public function index(Request $request)
 {
    $tab = $request->query('tab');

    if ($tab === 'mylist') {
        // とりあえずダミー（あとで本実装）
        $items = collect(); // 今は空でOK
    } else {
        $items = Item::all();
    }

    return view('items.index', compact('items', 'tab'));
 }

 public function show($item_id)
 {
    $item = Item::findOrFail($item_id);

    return view('items.show', compact('item'));
  }

  public function store(Request $request)
 {
    Item::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => null,
        'user_id' => Auth::id(),
    ]);

    return redirect('/');
 }

 public function create()
 {
    return view('items.create');
 }
}
