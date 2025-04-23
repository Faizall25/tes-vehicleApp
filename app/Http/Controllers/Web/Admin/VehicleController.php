<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'is_rented' => 'required|boolean',
            'capacity' => 'nullable|integer',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'capacity' => 'nullable|integer',
            'is_rented' => 'required|boolean',
        ]);

        $vehicle->update($request->all());
        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
