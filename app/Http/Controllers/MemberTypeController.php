<?php

namespace App\Http\Controllers;

use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class MemberTypeController extends Controller
{
    public function update(Request $req, $id)
    {
        $validated = Validator::make($req->all(), [
            'name' => 'required|string|max:100',
            'requirement' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);

        if ($validated->fails()) {
            return Redirect::back()->with('error', $validated->messages());
        }

        $type = MemberType::findOrFail($id);
        $type->name = $req->name;
        $type->weight_requirement = $req->requirement;
        $type->discount = $req->discount;
        $type->save();

        return Redirect::back()->with('success', 'Member type edited.');
    }
}
