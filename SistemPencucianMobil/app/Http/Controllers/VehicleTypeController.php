<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleTyp\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {

        $vehicleTypes = VehicleType::all();
        return view('vehicles.index-vehicle-types', compact('vehicleTypes'));
    }
}
