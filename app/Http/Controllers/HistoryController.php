<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::select(
            'order_details.id as id',
            'order_details.name as name',
            'services.name as service',
            'order_details.service_quantity as quantity',
            'order_details.discount as discount',
            'order_details.subtotal as subtotal',
            'order_details.total as total',
            'orders.order_date as order_date'
        )
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('services', 'order_details.service_id', '=', 'services.id')
        ->orderBy('orders.created_at', 'desc')
        ->get();

        return Inertia::render('history/History', compact('orders'));
    }

    public function show($id)
    {
        $order = OrderDetail::findOrFail($id);
        $member = Member::select('id')->where('name', $order->name)->get();
        
        return Inertia::render('history/Info');
    }
}
