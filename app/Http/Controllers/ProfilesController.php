<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
    	$activities = $user->activities()->latest()->get();
    	return view('profile.show',compact('activities', 'user'));
    }
}
