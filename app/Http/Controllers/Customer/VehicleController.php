<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->latest()->get();
        return view('customer.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('customer.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        Auth::user()->vehicles()->create($request->only(['license_plate', 'brand', 'model', 'year']));

        return redirect()->route('customer.vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorizeOwner($vehicle);
        return view('customer.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeOwner($vehicle);
        $request->validate($this->rules($vehicle));

        $vehicle->update($request->only(['license_plate', 'brand', 'model', 'year']));

        return redirect()->route('customer.vehicles.index')->with('success', 'Kendaraan berhasil diupdate.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorizeOwner($vehicle);
        $vehicle->delete();
        return redirect()->route('customer.vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }

    private function authorizeOwner(Vehicle $vehicle): void
    {
        abort_if($vehicle->user_id !== Auth::id(), 403);
    }

    private function rules(?Vehicle $vehicle = null): array
    {
        return [
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,' . ($vehicle?->id),
            'brand'         => 'required|string|max:255',
            'model'         => 'required|string|max:255',
            'year'          => 'required|integer|min:1900|max:' . date('Y'),
        ];
    }
}