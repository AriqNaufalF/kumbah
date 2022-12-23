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
        $employees = User::select(
            'id',
            'name',
            'address',
            'phone',
            'email',
            DB::raw(
                '(CASE WHEN gender = 1 THEN "Male"
                WHEN gender = 2 THEN "Female"
                END) as gender'
            )
        )->where('active', '=', 1)->orderBy('id', 'asc')->paginate(15);
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

        return redirect('employee')->with('success', 'Employee added.');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return Inertia::render('employee/EditEmployee', compact('employee'));
    }

    public function update(Request $req, $id)
    {
        $employee = User::findOrFail($id);

        if ($req->email === $employee->email) {
            $req->validate([
                'email' => 'required',
            ]);
        } else {
            $req->validate([
                'email' => 'required|email|unique:users',
            ]);
        }
        $req->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'address' => 'required|max:100',
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

        return redirect('employee')->with('success', 'Employee data updated.');
    }

    public function deactivate(Request $req)
    {
        $user = User::findOrFail($req->id)->update([
            'active' => false
        ]);
        // dd($user);
        return redirect('employee')->with('success', 'Employee deactivated.');
    }
}
