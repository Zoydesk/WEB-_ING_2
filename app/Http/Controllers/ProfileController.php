<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller {
  public function show(){
    return view('profile.show',[
      'user'=>auth()->user(),
      'methods'=>PaymentMethod::where('user_id',auth()->id())->get()
    ]);
  }
  public function storePaymentMethod(Request $r){
    $data = $r->validate(['card_number'=>'required|min:12','brand'=>'nullable|string']);
    PaymentMethod::create([
      'user_id'=>auth()->id(),
      'brand'=>$data['brand'] ?? 'SIMULATED',
      'last4'=>substr(preg_replace('/\D/','',$data['card_number']),-4),
      'token'=>'tok_'.Str::random(16)
    ]);
    return back()->with('ok','Método de pago guardado (simulado).');
  }
}
