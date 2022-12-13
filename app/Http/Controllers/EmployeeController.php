<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Inertia\Inertia;
use DB;
use Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::select('id', 'name', 'address', 'phone', 'email',
                                DB::raw(
                                    '(CASE 
                                        WHEN gender = 1 THEN "Lelaki"
                                        WHEN gender = 2 THEN "Perempuan"
                                    END) as gender'
                                )
                            )
                        ->orderBy('id', 'asc')
                        ->get();
        dd($employees);
        return Inertia::render('employee/Employee', compact("employees"));
    }

    public function create()
    {
        return Inertia::render('employee/AddEmployee');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'address' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|max_digits:13',
            'password' => 'required|min:8|max:16',
        ]);

        $employee = new User();
        $employee->name = $req->name;
        $employee->gender = $req->gender;
        $employee->address = $req->address;
        $employee->phone = $req->phone;
        $employee->email = $req->email;
        $employee->password = Hash::make($req->password);
        $employee->isAdmin = $req->isAdmin;
        $employee->save();

        return redirect('employee');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return Inertia::render('employee/EditEmployee', compact('employee'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'address' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|max_digits:13',
            'password' => 'required|min:8|max:16',
        ]);

        $employee = User::findOrFail($req->id);
        $employee->name = $req->name;
        $employee->gender = $req->gender;
        $employee->address = $req->address;
        $employee->phone = $req->phone;
        $employee->email = $req->email;
        $employee->password = Hash::make($req->password);
        $employee->isAdmin = $req->isAdmin;
        $employee->save();

        return redirect('employee');
    }
}
