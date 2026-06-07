<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function create(Item $item)
    {
        $user = auth()->user();

        $shippingAddress = [
           'postal_code' => session('postal_code', $user->postal_code),
           'address' => session('address', $user->address),
           'building' => session('building', $user->building),
        ];

        return view('purchase.create', compact('item', 'user','shippingAddress'));
    }

    public function store(PurchaseRequest $request, Item $item)
    {
       session([
        'payment_method' => $request->payment_method,
       ]);
    
      Stripe::setApiKey(config('services.stripe.secret'));

       $session = Session::create([
           'payment_method_types' => ['card'],
           'line_items' => [[
             'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                       'name' => $item->name,
                   ],
                   'unit_amount' => $item->price,
               ],
               'quantity' => 1,
           ]],
           'mode' => 'payment',
           'success_url' => route('purchase.success', ['item' => $item->id]),
           'cancel_url' => route('purchase.cancel', ['item' => $item->id]),
       ]);

       return redirect($session->url);
    }

    public function success(Item $item)
    {
       $user = auth()->user();

       Purchase::create([
           'user_id' => $user->id,
           'item_id' => $item->id,
           'payment_method' => session('payment_method'),
           'postal_code' => session('postal_code', $user->postal_code),
           'address' => session('address', $user->address),
           'building' => session('building', $user->building),
        ]);

       return redirect('/');
    }

    public function cancel(Item $item)
    {
       return redirect('/purchase/' . $item->id)
           ->with('error', '決済がキャンセルされました');
    }

    public function address(Item $item)
    {
        $user = auth()->user();

        return view('purchase.address', compact(
            'item',
            'user'
        ));
    }
    
   public function updateAddress(AddressRequest $request, Item $item)
    {
       session([
           'postal_code' => $request->postal_code,
           'address' => $request->address,
           'building' => $request->building,
       ]);

       return redirect('/purchase/' . $item->id);
    }

}

