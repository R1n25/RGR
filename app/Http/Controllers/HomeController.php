<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Category;
use App\Models\CarBrand;

class HomeController extends Controller
{
    public function index()
    {
        $popularParts = Part::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
            
        $categories = Category::whereNull('parent_id')->get();
        $brands = CarBrand::all();

        return view('home', compact('popularParts', 'categories', 'brands'));
    }
} 