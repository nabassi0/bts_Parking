<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\reservation;
use App\Models\utilisateur;
use DateTime;
use Illuminate\Support\Facades\Hash;

class user extends Controller
{
    public function reservation()
    {
        $requete = utilisateur::select('*')->where('idUtilisateur', '=', $_POST['id'])->get();
        foreach ($requete as $requetedata) {
            $id = $requetedata->idUtilisateur;
            $nom = $requetedata->nom;
            $prenom = $requetedata->prenom;
        }
        $info = array(
            0 => $id,
            1 => $nom,
            2 => $prenom,
        );

        $reservation = reservation::select('idReservation')->where('utilisateur', '=', $info[0])->count();

        $dbreserv = array(
            0 => 0,
            1 => null,
        );

        if ($reservation == 0) {
            $dbreserv[0] = 1;
        }

        $dbreserv[1] = reservation::leftJoin('parkings', 'idParking', '=', 'reservations.numeroPlace')->select('*')->where('utilisateur', '=', $info)->get();

        return view('user.reservation', compact('info'), compact('dbreserv'));
    }

    public function annule()
    {
        $annule = reservation::where('idReservation', '=', $_POST['id'])
            ->update(['etatReservation' => 1]);
        $id = $_POST['iduser'];
        $action = $_POST['action'];
        return view('user.acceuiluser', compact('action'), compact('id'));
    }

    public function formMDP()
    {
        $requete = utilisateur::select('*')->where('idUtilisateur', '=', $_POST['id'])->get();
        foreach ($requete as $requetedata) {
            $id = $requetedata->idUtilisateur;
            $nom = $requetedata->nom;
            $prenom = $requetedata->prenom;
        }
        $info = array(
            0 => $id,
            1 => $nom,
            2 => $prenom,
        );

        return view('user.modificationmdp', compact('info'));
    }

    public function confirmMDP()
    {

        $action = 2;
        $user = array(
            0 => $_POST['iduser'],
            1 => 0,
        );
        $connect = utilisateur::select('motDePasseUtilisateur')->where('idUtilisateur', '=', $user[0])->get();
        foreach ($connect as $connectdata) {
            $old = $connectdata->motDePasseUtilisateur;
        }
        if (Hash::check($_POST['old'], $old)) {
            $update = utilisateur::where('idUtilisateur', '=', $user[0])
                ->update(['motDePasseUtilisateur' => Hash::make($_POST['new'])]);
            $user[1] = 2;
        } else {
            $user[1] = 1;
        }
        return view('user.acceuiluser', compact('action', 'user'));
    }

    public function test()
    {
        $notein = reservation::select('parkings.numeroPlace AS numeroPlace')->join('utilisateurs', 'reservations.utilisateur', '=', 'idUtilisateur')->join('parkings', 'parkings.idParking', '=', 'reservations.numeroPlace')->where('dateFin', '>', date('Y-m-d'))->where('etatReservation', '=', 0)->get()->toArray();
        $placesLibres = parking::select('idParking', 'numeroPlace')->whereNotIn('idParking', $notein)->get();
        return $placesLibres;
    }

    public function ReservationExe()
    {
        $action = 1;
        $id = $_POST['iduser'];
        $date = new DateTime();
        $notein = reservation::select('parkings.numeroPlace AS numeroPlace')->join('utilisateurs', 'reservations.utilisateur', '=', 'idUtilisateur')->join('parkings', 'parkings.idParking', '=', 'reservations.numeroPlace')->where('dateFin', '>', date('Y-m-d'))->where('etatReservation', '=', 0)->get()->toArray();
        $placesLibres = parking::select('idParking')->whereNotIn('idParking', $notein)->get();
        // $placesLibres = parking::leftJoin('reservations', 'reservations.numeroPlace','=','parkings.idParking')->
        //                   select('parkings.idParking')->where('dateFin','<', $date->format('Y-m-d'))
        //                                                 ->orWhere('etatReservation','=', 1)->distinct()->get();
        $nbPlacesLibres = count($placesLibres);
        $attente = reservation::select('positionFIleAttente')->max('positionFileAttente') + 1;
        if ($nbPlacesLibres > 0) {
            $nbPlacesLibres--;
            $input = rand(0, $nbPlacesLibres);
            $nbplace = $placesLibres[$input];
            $nbplace = explode(':', $nbplace);
            $nbplace = explode('}', $nbplace[1]);
            $nbplace = $nbplace[0];
            $datedebut = date('Y-m-d');
            $datefin = date('Y-m-d', strtotime('+1 month'));
            reservation::insert([
                'positionFileAttente' => null,
                'numeroPlace' => $nbplace,
                'utilisateur' => $id,
                'etatReservation' => 0,
                'dateDebut' => $datedebut,
                'dateFin' => $datefin,
            ]);
        } else {
            reservation::insert([
                'positionFileAttente' => $attente,
                'numeroPlace' => null,
                'utilisateur' => $id,
                'etatReservation' => 0,
                'dateDebut' => NULL,
                'dateFin' => NULL,
            ]);
        }
        return view('user.acceuiluser', compact('action', 'id'));
    }
}
