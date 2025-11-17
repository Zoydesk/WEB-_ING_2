<?php

namespace App\Http\Controllers;

use App\Models\{Vehicle,Rate};
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function dashboard(){ return view('admin.dashboard'); }
    public function index(){ $vehicles=Vehicle::with('rate')->paginate(20); return view('admin.vehicles.index',compact('vehicles')); }
    public function create(){ return view('admin.vehicles.create'); }
    public function store(Request $r){
        $data=$r->validate(['name'=>'required','brand'=>'required','category'=>'required','hour_price'=>'required|numeric','description'=>'nullable']);
        $v=Vehicle::create($data);
        Rate::create(['vehicle_id'=>$v->id,'hour_price'=>$data['hour_price']]);
        return redirect()->route('admin.vehicles.index');
    }
    public function edit(Vehicle $vehicle){ $vehicle->load('rate'); return view('admin.vehicles.edit',compact('vehicle')); }
    public function update(Request $r, Vehicle $vehicle){
        $data=$r->validate(['name'=>'required','brand'=>'required','category'=>'required','hour_price'=>'required|numeric','description'=>'nullable']);
        $vehicle->update($data);
        $vehicle->rate()->update(['hour_price'=>$data['hour_price']]);
        return back()->with('ok','Actualizado');
    }
    public function destroy(Vehicle $vehicle){ $vehicle->delete(); return back(); }
}
