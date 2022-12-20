<?php

namespace App\Http\Controllers;

use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberTypeController extends Controller
{
    public function update(Request $req, $id)
    {
        $validated = Validator::make($req->all(), [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);

        if ($validated->fails()) {
            return Redirect::back()->with('error', 'Input error');
        }

        $type = MemberType::findOrFail($id);
        $type->name = $req->name;
        $type->price = $req->price;
        $type->discount = $req->discount;
        $type->save();

        return Redirect::back()->with('success', 'Member type edited.');
    }
}
