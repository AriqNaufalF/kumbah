<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table    = 'members';
    protected $fillable = ['name', 'member_type_id', 'phone', 'email', 'join_date', 'expired_date'];
}
