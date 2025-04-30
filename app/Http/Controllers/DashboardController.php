<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTransactions = Transaction::count();

        $recentAudits = Audit::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalCategories',
            'totalTransactions',
            'recentAudits'
        ));
    }
}
