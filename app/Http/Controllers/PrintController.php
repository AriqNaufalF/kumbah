<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use PDF;

class PrintController extends Controller
{
    public function printInvoice($id)
    {
        $data = OrderDetail::select(
            'orders.id as order_id',
            'orders.order_date as order_date',
            'orders.finished_date as finished_date',
            'members.id as member_id',
            'order_details.name as customer_name',
            'services.name as service_name',
            'order_details.service_quantity as service_quantity',
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
        
        $pdf = PDF::loadView('pdf_view', compact('data'));
        $pdf->setPaper('A6');

        return $pdf->stream('IVC_' . $data->order_date . '_' . $data->order_id);
    }
}
