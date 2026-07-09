<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index()
    {
        $spareParts = SparePart::with(['category', 'stocks'])->latest()->get();

        $total  = $spareParts->count();
        $counts = $spareParts->countBy('is_active');
        $active   = $counts->get(true, 0);
        $inactive = $counts->get(false, 0);

        return view('admin.spare-parts.index', compact('spareParts', 'total', 'active', 'inactive'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.spare-parts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        unset($data['stocks']);

        $sparePart = SparePart::create($data);
        $this->syncStocks($sparePart, $request);

        return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part berhasil ditambahkan.');
    }

    public function edit(SparePart $sparePart)
    {
        $categories = Category::orderBy('name')->get();
        $stocks = $sparePart->stocks->keyBy('condition');
        return view('admin.spare-parts.edit', compact('sparePart', 'categories', 'stocks'));
    }

    public function update(Request $request, SparePart $sparePart)
    {
        if ($request->has('is_active')) {
            $sparePart->update(['is_active' => $request->boolean('is_active')]);
            return redirect()->route('admin.spare-parts.index');
        }

        $data = $request->validate($this->rules($sparePart));
        unset($data['stocks']);

        $sparePart->update($data);
        $this->syncStocks($sparePart, $request, update: true);

        return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part berhasil diupdate.');
    }

    private function rules(?SparePart $sparePart = null): array
    {
        return [
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'part_number'    => 'required|string|max:255|unique:spare_parts,part_number,' . $sparePart?->id,
            'brand'          => 'required|string|max:255',
            'unit'           => 'required|string|max:50',
            'stock_minimum'  => 'required|integer|min:0',
            'stocks.*.stock' => 'required|integer|min:0',
            'stocks.*.price' => 'required|numeric|min:0',
        ];
    }

    private function syncStocks(SparePart $sparePart, Request $request, bool $update = false): void
    {
        foreach (['new', 'used'] as $condition) {
            $values = [
                'stock' => $request->input("stocks.{$condition}.stock"),
                'price' => $request->input("stocks.{$condition}.price"),
            ];

            $update
                ? $sparePart->stocks()->updateOrCreate(['condition' => $condition], $values)
                : $sparePart->stocks()->create($values + ['condition' => $condition]);
        }
    }
}