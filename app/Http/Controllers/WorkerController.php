<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
  public function dashboard()
  {
    $today = now();
    $start = $today->copy()->startOfDay();
    $end   = $today->copy()->endOfDay();

    // ENTREGAS A DOMICILIO (hoy): reservas confirmadas que empiezan hoy
    $deliveries = Reservation::with('user', 'vehicle')
      ->where('delivery_mode', 'HOME')
      ->whereBetween('start_at', [$start, $end])
      ->whereIn('status', ['CONFIRMED'])
      ->orderBy('start_at')
      ->get();

    // RECOGIDAS A DOMICILIO (hoy): reservas en curso que terminan hoy
    $pickups = Reservation::with('user', 'vehicle')
      ->where('delivery_mode', 'HOME')
      ->whereBetween('end_at', [$start, $end])
      ->whereIn('status', ['IN_PROGRESS'])
      ->orderBy('end_at')
      ->get();

    return view('worker.dashboard', compact('deliveries', 'pickups'));
  }

  public function deliver(Reservation $reservation)
  {
    return view('worker.deliver', compact('reservation'));
  }

  public function confirmDeliver(Request $r, Reservation $reservation)
  {
    // Cuando el worker entrega el vehículo, la reserva pasa a EN CURSO
    $reservation->update([
      'status' => 'IN_PROGRESS',
    ]);

    return back()->with('ok', 'Entrega confirmada.');
  }

  public function receive(Reservation $reservation)
  {
    return view('worker.receive', compact('reservation'));
  }

  public function confirmReceive(Request $r, Reservation $reservation)
  {

    
    $data = $r->validate([
      'rating'          => 'nullable|integer|min:1|max:5',
      'rating_comment'  => 'nullable|string|max:1000',
    ]);

    $reservation->update([
      'status'         => 'FINISHED', // importante
      'final_total'    => $reservation->estimated_total,
      'rating'         => $data['rating'] ?? null,
      'rating_comment' => $data['rating_comment'] ?? null,
    ]);

    $reservation->vehicle()->increment('stock');

    return redirect()
      ->route('worker.dashboard')
      ->with('ok', 'Devolución confirmada.');
  }
}
