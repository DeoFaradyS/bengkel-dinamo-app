<x-layouts.app>

    <section class="min-h-screen flex items-center justify-center py-16">

        <x-card class="w-full max-w-2xl flex flex-col gap-8">

            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                Buat Janji Servis
            </h1>

            @if (session('success'))
                <div class="p-4 rounded-[10px] bg-green-50 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form class="space-y-6" action="{{ route('booking.store') }}" method="POST" novalidate>
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <x-forms.input label="Nama" name="customer_name" type="text" placeholder="Nama Anda"
                        :error="$errors->first('customer_name')" class="col-span-2 lg:col-span-1" required />

                    <x-forms.input label="Nomor WhatsApp" name="customer_phone" type="tel" placeholder="08xxxxxxxxxx"
                        :error="$errors->first('customer_phone')" class="col-span-2 lg:col-span-1" required />

                    <x-forms.input label="Plat Nomor" name="license_plate" type="text" placeholder="N 1234 XX"
                        :error="$errors->first('license_plate')" class="col-span-2 lg:col-span-1" required />

                    <x-forms.input label="Model Kendaraan" name="vehicle_model" type="text" placeholder="Avanza 2019"
                        :error="$errors->first('vehicle_model')" class="col-span-2 lg:col-span-1" required />

                    <x-forms.input label="Tahun Kendaraan" name="year" type="number" placeholder="2019"
                        :error="$errors->first('year')" class="col-span-2 lg:col-span-1" required />

                    <x-forms.input label="Jadwal" name="scheduled_at" type="datetime-local"
                        :error="$errors->first('scheduled_at')" class="col-span-2 lg:col-span-1" required />
                </div>

                <div>
                    <label class="text-sm font-medium text-neutral-700">Jenis Servis</label>
                    <div class="flex gap-6 mt-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="service_type" value="workshop" checked
                                onchange="document.getElementById('home-service-fields').classList.add('hidden')">
                            Datang ke bengkel
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="service_type" value="home_service"
                                onchange="document.getElementById('home-service-fields').classList.remove('hidden')">
                            Panggil ke lokasi
                        </label>
                    </div>
                    @error('service_type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div id="home-service-fields" class="hidden grid grid-cols-2 gap-4">
                    <x-forms.input label="Alamat" name="customer_address" type="text" placeholder="Alamat lengkap"
                        :error="$errors->first('customer_address')" class="col-span-2" />
                    <x-forms.input label="Latitude" name="customer_lat" type="text" placeholder="-7.71"
                        :error="$errors->first('customer_lat')" class="col-span-2 lg:col-span-1" />
                    <x-forms.input label="Longitude" name="customer_lng" type="text" placeholder="113.07"
                        :error="$errors->first('customer_lng')" class="col-span-2 lg:col-span-1" />
                </div>

                <div>
                    <label class="text-sm font-medium text-neutral-700">Pilih Servis</label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        @foreach ($services as $service)
                            <label class="flex items-center gap-2 p-3 rounded-[10px] bg-neutral-100">
                                <input type="checkbox" name="service_ids[]" value="{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('service_ids') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-neutral-700">Keluhan (opsional)</label>
                    <textarea name="complaint" rows="3"
                        class="w-full p-4 rounded-[10px] bg-neutral-100 mt-2">{{ old('complaint') }}</textarea>
                </div>

                <x-button type="submit" variant="primary" class="w-full">
                    Buat Janji Servis
                </x-button>

            </form>

        </x-card>

    </section>

</x-layouts.app>