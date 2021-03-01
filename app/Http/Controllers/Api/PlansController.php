<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        return response()->json(['plans' => Plan::all()]);
    }
}
