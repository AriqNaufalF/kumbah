<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $todayOrder = OrderDetail::whereDate('created_at', Carbon::today())->count('id');
        $todayIncome = OrderDetail::whereDate('created_at', Carbon::today())->sum('total');
        $totalEmployee = User::where('active', '=', 1)->count('id');
        $totalMember = Member::whereDate('expired_date', '>=', Carbon::now())->count('id');
        $yearlyOrders = Order::whereBetween('order_date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        $ongoingOrders = OrderDetail::select(
            'orders.id as id',
            'order_details.name as name',
            'services.name as service',
            DB::raw('CONCAT(order_details.service_quantity, " ", services.unit) as quantity'),
            'order_details.total as total',
            'orders.order_date as order_date',
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('members', 'orders.member_id', '=', 'members.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->whereNull('orders.finished_date')
            ->orderBy('orders.created_at', 'asc')
            ->paginate(5);

        return Inertia::render('Dashboard', compact('todayOrder', 'todayIncome', 'ongoingOrders', 'totalEmployee', 'totalMember'));
    }

    public function addOrder()
    {
        $members = Member::select('members.id', 'members.name', 'member_types.discount')
            ->join('member_types', 'members.member_type_id', '=', 'member_types.id')
            ->whereDate('expired_date', '>=', Carbon::now())
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

        return Redirect::route('dashboard')->with('success', 'Order added successfully');
    }

    public function finishOrder(Request $req)
    {
        Order::findOrFail($req->id)->update([
            'finished_date' => Carbon::now()->toDateString()
        ]);

        return Redirect::back()->with('success', 'Order Finished');
    }
}
