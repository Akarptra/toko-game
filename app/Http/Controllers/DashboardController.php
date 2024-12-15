<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('nama', 'like', '%' . $search . '%')->paginate(12);
        } else {
            $products = Product::paginate(12);
        }
        return view('dashboard', compact('products'));
    }
}

