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

    public function updatePlan(Request $request)
    {
        $data = $request->all();

        Plan::where('id', $data['id'])->update([
            'stripe_id' => $data['stripe_id'],
            'pagseguro_id' => $data['pagseguro_id'],
            'name' => $data['name'],
            'value' => $data['value'],
        ]);

        return response()->json(['plan' => Plan::find($data['id'])]);
    }
}
