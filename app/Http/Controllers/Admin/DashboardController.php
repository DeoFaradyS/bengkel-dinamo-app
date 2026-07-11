<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\SparePartStock;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats cards
        $pendingApproval = Booking::where('status', 'pending')->count();
        $todayBookings   = Booking::whereDate('scheduled_at', today())->count();
        $totalCustomers  = Booking::distinct('customer_phone')->count('customer_phone');
        $lowStock = SparePartStock::whereColumn('stock', '<=', 'spare_parts.stock_minimum')
            ->join('spare_parts', 'spare_part_stocks.spare_part_id', '=', 'spare_parts.id')
            ->count();

        $todayRevenue = Booking::whereDate('scheduled_at', today())
            ->where('status', 'done')
            ->with(['services', 'spareParts'])
            ->get()
            ->sum(function ($booking) {
                $services   = $booking->services->sum('price');
                $spareParts = $booking->spareParts->sum(fn($sp) => $sp->price * $sp->quantity);
                return $services + $spareParts;
            });

        // Chart — booking 7 hari terakhir (1 query, bukan 7)
        $counts = Booking::selectRaw('DATE(scheduled_at) as day, COUNT(*) as total')
            ->whereDate('scheduled_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('day')
            ->pluck('total', 'day');

        $chartData = collect(range(6, 0))->map(function ($daysAgo) use ($counts) {
            $date = now()->subDays($daysAgo);
            return [
                'date'  => $date->format('d M'),
                'count' => $counts->get($date->format('Y-m-d'), 0),
            ];
        });

        // Recent bookings
        $recentBookings = Booking::with('vehicle')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingApproval',
            'todayBookings',
            'todayRevenue',
            'totalCustomers',
            'lowStock',
            'chartData',
            'recentBookings'
        ));
    }
}