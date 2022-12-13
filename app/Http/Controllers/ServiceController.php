<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return Inertia::render('service/Service', compact('services'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $service = new Service();
        $service->name = $req->name;
        $service->price = $req->price;
        $service->unit = $req->unit;
        $service->save();
    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $service = Service::findOrFail($req->id);
        $service->name = $req->name;
        $service->price = $req->price;
        $service->unit = $req->unit;
        $service->save();
    }
}
