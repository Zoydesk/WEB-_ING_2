<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CatalogController extends Controller
{
  public function index(Request $r)
  {
    // Cargamos tarifa y promedio de rating por vehículo
    $q = Vehicle::with('rate')
      ->withAvg('reservations', 'rating');

    if ($r->filled('category')) {
      $q->where('category', $r->string('category'));
    }

    if ($r->filled('brand')) {
      $q->where('brand', 'like', '%' . $r->string('brand') . '%');
    }

    if ($r->filled('min_price') || $r->filled('max_price')) {
      $q->whereHas('rate', function ($qq) use ($r) {
        if ($r->filled('min_price')) {
          $qq->where('hour_price', '>=', (float) $r->min_price);
        }
        if ($r->filled('max_price')) {
          $qq->where('hour_price', '<=', (float) $r->max_price);
        }
      });
    }

    if ($r->filled('start_at') && $r->filled('end_at')) {
      $start = Carbon::parse($r->start_at);
      $end   = Carbon::parse($r->end_at);

      $q->whereDoesntHave('reservations', function ($qr) use ($start, $end) {
        $qr->whereIn('status', ['PENDING', 'CONFIRMED', 'IN_PROGRESS'])
          ->where(function ($x) use ($start, $end) {
            $x->whereBetween('start_at', [$start, $end])
              ->orWhereBetween('end_at', [$start, $end])
              ->orWhere(function ($y) use ($start, $end) {
                $y->where('start_at', '<=', $start)
                  ->where('end_at', '>=', $end);
              });
          });
      });
    }

    $vehicles = $q->orderBy('name')
      ->paginate(12)
      ->appends($r->query());

    return view('catalog.index', compact('vehicles'));
  }

  public function show(Vehicle $vehicle)
  {
    // Cargar tarifa y promedio de rating para este vehículo
    $vehicle->load('rate')
      ->loadAvg('reservations', 'rating');

    return view('catalog.show', compact('vehicle'));
  }
}
