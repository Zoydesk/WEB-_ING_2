<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationRatingController extends Controller
{
    public function store(Request $request, Reservation $reservation)
    {
        // Asegurarse de que el usuario es el dueño de la reserva
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'rating'         => ['required', 'integer', 'min:1', 'max:5'],
            'rating_comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $reservation->update($data);

        return back()->with('success', 'Gracias por tu reseña.');
    }
}
