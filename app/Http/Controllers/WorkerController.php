<?php

namespace App\Http\Controllers;

use App\Models\{Reservation};
use Illuminate\Http\Request;

class WorkerController extends Controller {
  public function dashboard(){
    $now = now();
    $toDeliver = Reservation::with('user','vehicle')
      ->whereDate('start_at',$now->toDateString())
      ->whereIn('status',['CONFIRMED'])
      ->orderBy('start_at')->get();

    $toReceive = Reservation::with('user','vehicle')
      ->whereDate('end_at',$now->toDateString())
      ->whereIn('status',['IN_PROGRESS'])
      ->orderBy('end_at')->get();

    return view('worker.dashboard', compact('toDeliver','toReceive'));
  }

  public function deliver(Reservation $reservation){ return view('worker.deliver', compact('reservation')); }
  public function confirmDeliver(Request $r, Reservation $reservation){
    $reservation->update(['status'=>'IN_PROGRESS']);
    return back()->with('ok','Entrega confirmada.');
  }
  public function receive(Reservation $reservation){ return view('worker.receive', compact('reservation')); }
  public function confirmReceive(Request $r, Reservation $reservation){
    $data = $r->validate(['rating'=>'nullable|integer|min:1|max:5','rating_comment'=>'nullable|string|max:1000']);
    $reservation->update([
      'status'=>'FINISHED','final_total'=>$reservation->estimated_total,
      'rating'=>$data['rating'] ?? null,'rating_comment'=>$data['rating_comment'] ?? null
    ]);
    $reservation->vehicle()->increment('stock');
    return back()->with('ok','Devolución confirmada.');
  }
}
