<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingSparepart;
use App\Models\SparePartStock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function booking(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $bookings = Booking::with(['user', 'vehicle', 'services.service'])
            ->whereMonth('scheduled_at', $month)
            ->whereYear('scheduled_at', $year)
            ->latest()
            ->get();

        $total       = $bookings->count();
        $scheduled   = $bookings->where('status', 'scheduled')->count();
        $in_progress = $bookings->where('status', 'in_progress')->count();
        $done        = $bookings->where('status', 'done')->count();
        $cancelled   = $bookings->where('status', 'cancelled')->count();

        return view('admin.reports.booking', compact('bookings', 'total', 'scheduled', 'in_progress', 'done', 'cancelled', 'month', 'year'));
    }

    public function revenue(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $bookings = Booking::with(['services.service', 'spareParts.sparePartStock.sparePart'])
            ->whereMonth('scheduled_at', $month)
            ->whereYear('scheduled_at', $year)
            ->where('status', 'done')
            ->latest()
            ->get();

        $totalServices   = $bookings->sum(fn($b) => $b->services->sum('price'));
        $totalSpareParts = $bookings->sum(fn($b) => $b->spareParts->sum(fn($sp) => $sp->price * $sp->quantity));
        $totalRevenue    = $totalServices + $totalSpareParts;

        return view('admin.reports.revenue', compact('bookings', 'totalServices', 'totalSpareParts', 'totalRevenue', 'month', 'year'));
    }

    public function stock()
    {
        $stocks = SparePartStock::with(['sparePart.category'])
            ->get()
            ->filter(fn($stock) => $stock->stock <= $stock->sparePart->stock_minimum);

        return view('admin.reports.stock', compact('stocks'));
    }
}