<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'services.service'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Auth::user()->vehicles()->where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();

        return view('customer.bookings.create', compact('vehicles', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'    => ['required', Rule::exists('vehicles', 'id')->where('user_id', Auth::id())],
            'scheduled_at'  => 'required|date|after:now',
            'service_ids'   => 'required|array|min:1',
            'service_ids.*' => 'exists:services,id',
            'complaint'     => 'nullable|string|max:1000',
        ]);

        $booking = DB::transaction(function () use ($request) {
            $booking = Booking::create([
                'user_id'      => Auth::id(),
                'vehicle_id'   => $request->vehicle_id,
                'scheduled_at' => $request->scheduled_at,
                'complaint'    => $request->complaint,
                'status'       => 'scheduled',
            ]);

            $services = Service::whereIn('id', $request->service_ids)->get()->keyBy('id');

            foreach ($request->service_ids as $serviceId) {
                BookingService::create([
                    'booking_id' => $booking->id,
                    'service_id' => $serviceId,
                    'price'      => $services[$serviceId]->price_min,
                ]);
            }

            return $booking;
        });

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $booking->load(['vehicle', 'services.service']);

        return view('customer.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'scheduled', 403);

        $booking->delete();

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}