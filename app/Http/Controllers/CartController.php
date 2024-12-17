<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request)
    {
        $part = Part::findOrFail($request->part_id);
        
        return response()->json([
            'success' => true,
            'message' => 'Товар добавлен в корзину'
        ]);
    }

    public function remove(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Товар удален из корзины'
        ]);
    }

    public function update(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Корзина обновлена'
        ]);
    }
} 