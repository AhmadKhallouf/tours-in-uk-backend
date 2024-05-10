<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();

        return response()->api($drivers);
    }
}
