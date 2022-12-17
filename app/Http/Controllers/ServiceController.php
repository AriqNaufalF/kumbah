<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(15);
        return Inertia::render('service/Service', compact('services'));
    }

    public function store(Request $req)
    {
        $validated = Validator::make($req->all(), [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        if ($validated->fails()) {
            return Redirect::back()->with('error', $validated->messages());
        }

        $service = new Service();
        $service->name = $req->name;
        $service->price = $req->price;
        $service->unit = $req->unit;
        $service->save();

        return Redirect::back()->with('success', 'Service added.');
    }

    public function update(Request $req)
    {
        $validated = Validator::make($req->all(), [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        if ($validated->fails()) {
            return Redirect::back()->with('error', 'Input error');
        }

        $service = Service::findOrFail($req->id);
        $service->name = $req->name;
        $service->price = $req->price;
        $service->unit = $req->unit;
        $service->save();

        return Redirect::back()->with('success', 'Service edited.');
    }
}
