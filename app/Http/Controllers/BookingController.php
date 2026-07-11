<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\WorkshopSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create()
    {
        $services = Service::active()->get();

        return view('booking.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'license_plate' => ['required', 'string'],
            'vehicle_model' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'customer_name' => ['required', 'string'],
            'customer_phone' => ['required', 'string'],
            'service_type' => ['required', 'in:workshop,home_service'],
            'customer_address' => ['required_if:service_type,home_service', 'nullable', 'string'],
            'customer_lat' => ['required_if:service_type,home_service', 'nullable', 'numeric'],
            'customer_lng' => ['required_if:service_type,home_service', 'nullable', 'numeric'],
            'scheduled_at' => ['required', 'date'],
            'complaint' => ['nullable', 'string'],
            'service_ids' => ['required', 'array', 'min:1'],
            'service_ids.*' => ['exists:services,id'],
        ]);

        $booking = DB::transaction(function () use ($data) {
            $vehicle = Vehicle::firstOrCreate(
                ['license_plate' => $data['license_plate']],
                ['vehicle_model' => $data['vehicle_model'], 'year' => $data['year']]
            );

            $homeServiceFee = null;
            $distanceKm = null;

            if ($data['service_type'] === 'home_service') {
                $settings = WorkshopSetting::first();
                $distanceKm = $this->distanceKm(
                    $settings->latitude, $settings->longitude,
                    $data['customer_lat'], $data['customer_lng']
                );
                // ponytail: flat fee from settings, add distance-based tiers if needed later
                $homeServiceFee = $settings->default_home_service_fee;
            }

            $booking = Booking::create([
                'booking_code' => 'BK-' . strtoupper(Str::random(8)),
                'vehicle_id' => $vehicle->id,
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'service_type' => $data['service_type'],
                'customer_address' => $data['customer_address'] ?? null,
                'customer_lat' => $data['customer_lat'] ?? null,
                'customer_lng' => $data['customer_lng'] ?? null,
                'distance_km' => $distanceKm,
                'home_service_fee' => $homeServiceFee,
                'scheduled_at' => $data['scheduled_at'],
                'complaint' => $data['complaint'] ?? null,
                'status' => 'pending',
            ]);

            foreach (Service::whereIn('id', $data['service_ids'])->get() as $service) {
                $booking->services()->create([
                    'service_id' => $service->id,
                    'price' => $service->price_min,
                ]);
            }

            return $booking;
        });

        return redirect()->route('booking.create')
            ->with('success', "Booking berhasil, kode kamu: {$booking->booking_code}");
    }

    // ponytail: haversine, plain math, no package needed
    private function distanceKm(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }
}