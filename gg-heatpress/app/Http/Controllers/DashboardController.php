<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Bag;
use App\Models\Leftover;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'customerCount' => Customer::count(),
            'bagCount'      => Bag::count(),
            'leftoverCount' => Leftover::sum('quantity'),
            'expiringSoon'  => Leftover::where('expires_at', '<=', now()->addWeeks(2))->count(),
        ]);
    }
}
