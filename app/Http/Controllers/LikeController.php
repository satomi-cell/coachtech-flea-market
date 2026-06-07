<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class LikeController extends Controller
{
    public function store(Item $item)
    {
        auth()->user()->likeItems()->attach($item->id);

        return back();
    }

    public function destroy(Item $item)
    {
        auth()->user()->likeItems()->detach($item->id);

        return back();
    }
}
