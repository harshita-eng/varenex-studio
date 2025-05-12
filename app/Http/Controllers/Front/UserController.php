<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyNames;
use Auth;

class UserController extends Controller
{
    public function userDashboard() {

        $applications = CompanyNames::where('user_id', Auth::user()->id)->get();
        return view('Front.User.user_dashboard', compact('applications'));
    }

    public function accountSettings() {

        
    }
}
