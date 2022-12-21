<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::select(
            'orders.id as id',
            'order_details.name as name',
            DB::raw(
                '
                (CASE WHEN orders.member_id IS NULL THEN "-"
                ELSE (SELECT member_types.name FROM member_types
                WHERE member_types.id = members.member_type_id)
                END) AS member
                '
            ),
            'services.name as service',
            DB::raw('CONCAT(order_details.service_quantity, " ", services.unit) as quantity'),
            'order_details.total as total',
            'orders.order_date as order_date',
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('members', 'orders.member_id', '=', 'members.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->whereNotNull('orders.finished_date')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(15);

        return Inertia::render('history/History', compact('orders'));
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::select(
            'orders.id as order_id',
            'orders.order_date as order_date',
            'orders.finished_date as finished_date',
            'members.id as member_id',
            'order_details.name as customer_name',
            'services.name as service_name',
            DB::raw('CONCAT(order_details.service_quantity, " ", services.unit ) as service_quantity'),
            'order_details.subtotal as subtotal',
            'order_details.discount as discount',
            'order_details.total as total',
            'order_details.clothes as clothes'
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('members', 'orders.member_id', '=', 'members.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->where('orders.id', $id)
            ->first();

        return Inertia::render('history/Info', compact('orderDetail'));
    }
}
