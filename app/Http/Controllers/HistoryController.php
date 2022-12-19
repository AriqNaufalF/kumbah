<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryController extends Controller
{
    public function index()
    {
        return Inertia::render('history/History');
    }

    public function show($id)
    {
        return Inertia::render('history/Info');
    }
}
