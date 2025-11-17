<?php

namespace App\Http\Controllers;

use App\Models\{Vehicle,Reservation};
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller {
  public function create(Vehicle $vehicle){
    $vehicle->load('rate');
    return view('reservations.create', compact('vehicle'));
  }

  public function store(Request $r){
    $data = $r->validate([
      'vehicle_id'=>'required|exists:vehicles,id',
      'start_at'=>'required|date|after:now',
      'end_at'=>'required|date|after:start_at',
      'delivery_mode'=>'required|in:AGENCY,HOME',
      'delivery_address'=>'nullable|string'
    ]);
    $vehicle = Vehicle::with('rate')->findOrFail($data['vehicle_id']);
    if(!$vehicle->inStock()){
      return back()->withErrors(['stock'=>'Sin stock disponible para este vehículo.']);
    }

    $hours = Carbon::parse($data['start_at'])->diffInHours(Carbon::parse($data['end_at']));
    $estimated = $hours * ($vehicle->rate->hour_price ?? 0);

    $res = Reservation::create([
      'user_id'=>auth()->id(),
      'vehicle_id'=>$vehicle->id,
      'start_at'=>$data['start_at'],
      'end_at'=>$data['end_at'],
      'delivery_mode'=>$data['delivery_mode'],
      'delivery_address'=>$data['delivery_mode']==='HOME' ? $data['delivery_address'] : null,
      'estimated_total'=>$estimated,
      'status'=>'PENDING'
    ]);
    return redirect()->route('payments.checkout',$res);
  }

  public function my(){
    $reservations = Reservation::with('vehicle','payment')->where('user_id',auth()->id())->latest()->get();
    return view('reservations.my', compact('reservations'));
  }
}
