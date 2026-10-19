<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the dynamic admin dashboard.
     */
    public function index()
    {

        try {
            $orders = Order::latest()->get();
            $totalOrders = $orders->count();
            $completedOrders = $orders->filter(function ($o) {
                return in_array(strtolower($o->status), ['selesai', 'disetujui']);
            })->count();
            $pendingOrders = $orders->filter(function ($o) {
                return in_array(strtolower($o->status), ['dipending', 'pending']);
            })->count();
        } catch (\Throwable $e) {
            $orders = collect();
            $totalOrders = 0;
            $completedOrders = 0;
            $pendingOrders = 0;
        }

        return view('admin', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders'));
    }
}
