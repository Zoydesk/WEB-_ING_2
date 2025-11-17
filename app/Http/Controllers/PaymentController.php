<?php

namespace App\Http\Controllers;

use App\Models\{Reservation,Payment,PaymentMethod,Notification,Vehicle};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller {
  public function checkout(Reservation $reservation){
    $reservation->load('vehicle.rate','payment');
    $methods = PaymentMethod::where('user_id',auth()->id())->get();
    return view('payments.checkout', compact('reservation','methods'));
  }

  public function process(Request $r, Reservation $reservation){
    $data = $r->validate([
      'card_number'=>'required|min:12',
      'card_holder'=>'required',
      'exp'=>'required',
      'cvc'=>'required|min:3',
    ]);

    return DB::transaction(function() use ($reservation,$data){
      $veh = Vehicle::lockForUpdate()->find($reservation->vehicle_id);
      if(!$veh || $veh->stock <= 0){
        return back()->withErrors(['stock'=>'Sin stock disponible.']);
      }

      $last4 = substr(preg_replace('/\D/','',$data['card_number']), -4);
      PaymentMethod::create([
        'user_id'=>auth()->id(),
        'brand'=>'SIMULATED',
        'last4'=>$last4,
        'token'=>'tok_'.Str::random(16)
      ]);

      $payment = Payment::create([
        'reservation_id'=>$reservation->id,
        'amount'=>$reservation->estimated_total,
        'status'=>'APPROVED',
        'provider_intent'=>'sim_'.Str::uuid()
      ]);

      $reservation->update(['status'=>'CONFIRMED']);
      $veh->decrement('stock');

      Notification::create([
        'user_id'=>auth()->id(),
        'type'=>'PAYMENT_APPROVED',
        'content'=>"Pago aprobado por $$payment->amount para reserva #$reservation->id"
      ]);

      return redirect()->route('reservations.my')->with('ok','Pago simulado aprobado y guardado.');
    });
  }
}
