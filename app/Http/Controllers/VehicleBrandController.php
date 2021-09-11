<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\VehicleBrand;

class VehicleBrandController extends Controller
{
    public function index() {
        return VehicleBrand::all();
    }

    public function show(VehicleBrand $vehicleBrand)
    {
        return $vehicleBrand;
    }

    public function store(Request $request)
    {
        $vehicleBrand = VehicleBrand::create($request->all());
        return response()->json($vehicleBrand, 201);
    }

    public function update(Request $request, VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->update($request->all());

        return response()->json($vehicleBrand, 200);
    }

    public function destroy(VehicleBrand $vehicleBrand)
    {
        $vehicleBrand->delete();

        return response()->json(null, 204);
    }
}