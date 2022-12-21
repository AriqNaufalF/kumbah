<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $todayOrder = OrderDetail::whereDate('created_at', Carbon::today())->count('id');
        $todayIncome = OrderDetail::whereDate('created_at', Carbon::today())->sum('total');
        $yearlyOrders = Order::whereBetween('order_date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        return Inertia::render('Dashboard', compact('todayOrder', 'todayIncome'));
    }

    public function addOrder()
    {
        $members = Member::select('members.id', 'members.name', 'member_types.discount')
            ->join('member_types', 'members.member_type_id', '=', 'member_types.id')
            ->orderBy('id', 'asc')->get();
        $services = Service::all(['id', 'name', 'price', 'unit']);
        return Inertia::render('AddOrder', compact('members', 'services'));
    }

    public function addOrderStore(Request $req)
    {
        $validated = $req->validate([
            'memberId' => 'numeric|nullable',
            'name' => 'required|string|max:255',
            'discount' => 'numeric',
            'service' => 'required|numeric',
            'serviceQty' => 'required|numeric|min:1',
            'subTotal' => 'required|numeric|min:1',
            'totalPrice' => 'required|numeric',
            'clothes.*.cloth' => 'required|string|max:255',
            'clothes.*.quantity' => 'required|numeric|min:1'
        ], [
            'clothes.*.cloth.required' => '#:position cloth is required.',
            'clothes.*.cloth.max' => "#:position can't be longger than 255 characters.",
            'clothes.*.quantity.required' => '#:position cloth is required.',
            'clothes.*.quantity.min' => '#:position filled at least one'
        ]);

        $orderId = Order::create([
            'order_date' => Carbon::now()->toDateString(),
            'member_id' => $validated['memberId'],
            'employee_id' => auth()->user()->id,
        ])->id;

        OrderDetail::create([
            'order_id' => $orderId,
            'service_id' => $validated['service'],
            'service_quantity' => $validated['serviceQty'],
            'name' => $validated['name'],
            'clothes' => json_encode($validated['clothes']),
            'subtotal' => $validated['subTotal'],
            'discount' => $validated['discount'],
            'total' => $validated['totalPrice']
        ]);

        return back()->with('success', 'Order added successfully');
    }
}
