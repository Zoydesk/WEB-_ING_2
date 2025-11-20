@extends('layouts.app')
@section('content')
    @php
        $tags = match ($vehicle->category) {
            'SCOOTER_ELECTRICO' => 'electric scooter,city',
            'BICI' => 'bicycle,urban,cycle',
            'MOTO_ELECTRICA' => 'electric motorcycle,ev,bike',
            'PATINES' => 'inline skates,rollerblades,urban',
            default => 'micro mobility,urban',
        };
        $seed = $vehicle->id . '-' . substr(strtolower($vehicle->name), 0, 6);
    @endphp

    <div class="card glass">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-7">
                    <img class="vehicle-img"
                        src="https://source.unsplash.com/random/1000x560/?{{ urlencode($tags) }}&sig={{ md5($seed) }}"
                        onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ md5($seed) }}/1000/560';">
                </div>
                <div class="col-lg-5">
                    <h1 class="h3 fw-bold">{{ $vehicle->name }}</h1>

                    @php
                        $avg = round($vehicle->reservations_avg_rating ?? 0, 1);
                        $fullStars = floor($avg);
                    @endphp

                    @if ($avg > 0)
                        <p class="mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullStars)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="text-secondary small">({{ $avg }} / 5)</span>
                        </p>
                    @else
                        <p class="mb-1 text-secondary small">Sin reseñas todavía</p>
                    @endif

                    <p class="text-secondary mb-2">{{ $vehicle->brand }} • <span
                            class="badge text-bg-secondary">{{ $vehicle->category_label }}</span></p>
                    <p class="mb-3">{{ $vehicle->description }}</p>
                    <p class="fs-5">Precio por hora: <span
                            class="fw-semibold">${{ number_format($vehicle->rate->hour_price, 2) }}</span></p>
                    @auth
                        <a class="btn btn-primary btn-lg" href="{{ route('reservations.create', $vehicle) }}">Reservar</a>
                    @else
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Ingresar para reservar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
