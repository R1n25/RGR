<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::paginate(12);
        return view('parts.index', compact('parts'));
    }

    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    public function order(Request $request)
    {
        $validated = $request->validate([
            'parts' => 'required|array',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email'
        ]);

        // Логика оформления заказа
    }
} 