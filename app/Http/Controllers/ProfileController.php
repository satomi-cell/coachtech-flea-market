<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
     public function mypage()
    {
        $user = Auth::user();

        // 出品商品
        $sellItems = $user->items;

        // 購入商品
        $buyItems = $user->purchases;

        return view('mypage.index', compact('user', 'sellItems', 'buyItems'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required'],
            'postal_code' => ['required'],
            'address' => ['required'],
            'building' => ['nullable'],
            'profile_image' => ['nullable', 'image'],
        ]);

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

