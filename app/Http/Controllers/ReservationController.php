<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationController extends Controller
{

        public function index()
        {
          // dd($reservations);

            $reservations = Reservation::with('user')->get();

            return view('dashboard', ['reservations' => $reservations]);
        }

        public function store(Request $request)
        {
            $reservation = new Reservation();
            $reservation->user_id = auth()->id(); 
            $reservation->type = $request->type;
            $reservation->prix = $request->prix;
            $reservation->start_date = $request->start_date;
            $reservation->end_date = $request->end_date;
            $reservation->save();
        
            // Ajouter un message flash à la session
            session()->flash('success', 'La réservation a été enregistrée avec succès.');
        
            return redirect()->back(); // ou rediriger vers une autre page
        }
   
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->delete();
            return redirect()->route('dashboard')->with('success', 'Réservation supprimée avec succès.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Réservation introuvable.');
        }
    }
}
