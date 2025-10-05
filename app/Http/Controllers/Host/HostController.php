<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;
use App\Models\User;

class HostController extends Controller
{

    public function showHostProfile($id)
    {
        // Fetch the host
        $host = User::with('properties')->findOrFail($id);

        // Return a view and pass the host
        return view('host.show-profile', compact('host'));
    }
}
