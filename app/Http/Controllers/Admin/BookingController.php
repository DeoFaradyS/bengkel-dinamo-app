<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingSparepart;
use App\Models\SparePartStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle', 'services.service'])->latest()->get();

        $total  = $bookings->count();
        $counts = $bookings->countBy('status');
        $scheduled   = $counts->get('scheduled', 0);
        $in_progress = $counts->get('in_progress', 0);
        $done        = $counts->get('done', 0);

        return view('admin.bookings.index', compact('bookings', 'total', 'scheduled', 'in_progress', 'done'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'vehicle', 'services.service', 'spareParts.sparePartStock.sparePart']);
        $sparePartStocks = SparePartStock::with('sparePart')->get();

        return view('admin.bookings.show', compact('booking', 'sparePartStocks'));
    }

    public function update(Request $request, Booking $booking)
    {
        if ($request->has('status')) {
            $request->validate([
                'status' => 'required|in:scheduled,in_progress,done,cancelled',
            ]);

            $booking->update(['status' => $request->status]);
            return back()->with('success', 'Status berhasil diupdate.');
        }

        if ($request->has('spare_part_stock_id')) {
            $request->validate([
                'spare_part_stock_id' => 'required|exists:spare_part_stocks,id',
                'quantity'            => 'required|integer|min:1',
            ]);

            return DB::transaction(function () use ($request, $booking) {
                $stock = SparePartStock::lockForUpdate()->find($request->spare_part_stock_id);

                if ($request->quantity > $stock->stock) {
                    return back()->withErrors(['quantity' => 'Stok tidak cukup. Sisa stok: ' . $stock->stock]);
                }

                BookingSparepart::create([
                    'booking_id'          => $booking->id,
                    'spare_part_stock_id' => $stock->id,
                    'quantity'            => $request->quantity,
                    'price'               => $stock->price,
                ]);

                $stock->decrement('stock', $request->quantity);

                return back()->with('success', 'Spare part berhasil ditambahkan.');
            });
        }
    }
}