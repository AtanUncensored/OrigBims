<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
        $logs = auth()->user()->logs()->orderBy('created_at', 'desc')->get();
        return view('barangay.logs.index', compact('logs'));
    }
}
