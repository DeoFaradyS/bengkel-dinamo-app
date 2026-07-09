<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\SparePartStock;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats cards
        $todayBookings = Booking::whereDate('scheduled_at', today())->count();
        $totalCustomers = User::where('role', 'customer')->count();
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
        $recentBookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'todayBookings',
            'todayRevenue',
            'totalCustomers',
            'lowStock',
            'chartData',
            'recentBookings'
        ));
    }
}