<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
     public function mypage()
    {
        $user = Auth::user();

        // 出品商品
        $sellItems = $user->items;

        // 購入商品
        $buyItems = $user->purchasedItems;

        return view('mypage.index', compact('user', 'sellItems', 'buyItems'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage.profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profile_image')) {

            $path = $request->file('profile_image')->store('profile_images', 'public');

            $user->profile_image = $path;
        }

        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;

        $user->save();

        return redirect('/mypage');
    }

}

