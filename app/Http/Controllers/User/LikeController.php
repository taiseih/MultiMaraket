<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function store($productId)
    {
        Auth::user()->like($productId);
        return ; 
    }

    public function destroy($productId)
    {
        Auth::user()->dislike($productId);
        return ;
    }
}
