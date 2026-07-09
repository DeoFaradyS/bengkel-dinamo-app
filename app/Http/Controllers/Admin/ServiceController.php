<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();

        $total  = $services->count();
        $counts = $services->countBy('is_active');
        $active   = $counts->get(true, 0);
        $inactive = $counts->get(false, 0);

        return view('admin.services.index', compact('services', 'total', 'active', 'inactive'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        if ($request->has('is_active')) {
            $service->update(['is_active' => $request->boolean('is_active')]);
            return redirect()->route('admin.services.index');
        }

        $data = $request->validate($this->rules());
        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diupdate.');
    }

    private function rules(): array
    {
        return [
            'name'                   => 'required|string|max:255',
            'price_min'              => 'required|numeric|min:0',
            'price_max'              => 'required|numeric|gte:price_min',
            'estimated_time_minutes' => 'required|integer|min:1',
        ];
    }
}