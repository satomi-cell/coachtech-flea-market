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
    $keyword = $request->keyword;

    if ($tab === 'mylist') {
      
        // 未ログインなら空
        if (!Auth::check()) {
           
            $items = collect();
        
       } else {
           $items = Auth::user()
             ->likeItems()
             ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
             ->latest('items.created_at')
             ->get();
       }

    } else {

        $items = Item::query()

             //自分の商品を除外
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', '!=', Auth::id());
            })
            
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();
    }
   
     return view('items.index', compact('items', 'tab'));
 }

 public function show($item_id)
 {
      $item = Item::with([
            'comments.user',
            'categories',
         ])->findOrFail($item_id);

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
