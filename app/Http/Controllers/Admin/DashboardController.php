<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class DashboardController extends Controller
{
	function show_dashboard() {
		return view('admin.dashboard');
	}

}
