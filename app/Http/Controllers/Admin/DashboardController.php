<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Part;
use App\Models\Category;
use App\Http\Controllers\Controller;

class DashboardController extends AdminController
{
    public function index()
    {
        $stats = [
            'orders_count' => Order::count(),
            'parts_count' => Part::count(),
            'categories_count' => Category::count(),
            'recent_orders' => Order::latest()->take(5)->get(),
            'low_stock_parts' => Part::where('quantity', '<', 5)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 