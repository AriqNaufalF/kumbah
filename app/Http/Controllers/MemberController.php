<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use Inertia\Inertia;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::select('members.id', 'members.name', 'member_types.name as member_type',
                                  'members.phone', 'members.email', 'members.join_date', 'members.expired_date')
                        ->join('member_types', 'members.member_type_id', '=', 'member_types.id')
                        ->orderBy('id', 'asc')
                        ->get();
        return Inertia::render('member/Member', compact("members"));
    }

    public function create()
    {
        return Inertia::render('member/AddMember');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'phone' => 'required|numeric|max_digits:13',
            'email' => 'required|email|unique:members',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start'
        ]);

        $member = new Member();
        $member->name = $req->name;
        $member->member_type_id = $req->type;
        $member->phone = $req->phone;
        $member->email = $req->email;
        $member->join_date = $req->start;
        $member->expired_date = $req->end;
        $member->save();

        return redirect('member');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return Inertia::render('member/EditMember', compact('member'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'phone' => 'required|numeric|max_digits:13',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start'
        ]);

        $member = Member::findOrFail($req->id);

        if ($member->email != $req->email)
        {
            $req->validate(['email' => 'required|email|unique:members',]);
        }

        $member->name = $req->name;
        $member->member_type_id = $req->type;
        $member->phone = $req->phone;
        $member->email = $req->email;
        $member->join_date = $req->start;
        $member->expired_date = $req->end;
        $member->save();

        return redirect('member');
    }
}
