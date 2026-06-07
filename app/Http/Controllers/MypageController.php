<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $page = $request->page;
        
        // 出品した商品
        $sellItems = Item::where('user_id', $user->id)->get();

        // 購入した商品
        $buyItems = $user->purchasedItems;
        
        return view('mypage.index', compact(
            'user',
            'page',
            'sellItems',
            'buyItems'
            ));
    }
}
