<?php

namespace App\Http\Controllers;

use App\Models\{Vehicle, Reservation};
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;


class ReservationController extends Controller
{
  public function create(Vehicle $vehicle)
  {
    $vehicle->load('rate');
    return view('reservations.create', compact('vehicle'));
  }

  public function store(Request $r)
  {

    $minStart = now()->addHours(2);
    
    $data = $r->validate([
      'vehicle_id' => 'required|exists:vehicles,id',
      // start_at debe ser al menos dentro de 2 horas
      'start_at' => ['required', 'date', 'after_or_equal:' . $minStart],
      'end_at'   => ['required', 'date', 'after:start_at'],
      'delivery_mode' => 'required|in:AGENCY,HOME',
      'delivery_address' => 'nullable|string'
    ]);

    $vehicle = \App\Models\Vehicle::with('rate')->findOrFail($data['vehicle_id']);

    if (!$vehicle->inStock()) {
      return back()->withErrors(['stock' => 'Sin stock disponible para este vehículo.'])->withInput();
    }

    $start = \Carbon\Carbon::parse($data['start_at']);
    $end   = \Carbon\Carbon::parse($data['end_at']);
    $hours = $start->diffInHours($end);
    if ($hours <= 0) {
      return back()->withErrors(['start_at' => 'Rango de horas inválido'])->withInput();
    }

    $estimated = $hours * ($vehicle->rate->hour_price ?? 0);

    $res = \App\Models\Reservation::create([
      'user_id' => auth()->id(),
      'vehicle_id' => $vehicle->id,
      'start_at' => $start,
      'end_at' => $end,
      'delivery_mode' => $data['delivery_mode'],
      'delivery_address' => $data['delivery_mode'] === 'HOME' ? ($data['delivery_address'] ?? null) : null,
      'estimated_total' => $estimated,
      'status' => 'PENDING'
    ]);

    // dd('voy a checkout', $res->id); // <-- descomenta para probar y ver si entra aquí

    return redirect()->route('payments.checkout', $res);
  }


  public function my()
  {
    $reservations = Reservation::with('vehicle', 'payment')->where('user_id', auth()->id())->latest()->get();
    return view('reservations.my', compact('reservations'));
  }
}
