<?php

namespace App\Http\Controllers;

use App\Models\parking;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ChangeMDP;
use Illuminate\Http\Request;
use App\Models\reservation;
use App\Models\utilisateur;
use DateTime;
use Illuminate\Support\Facades\Hash;

class admin extends Controller
{
    public function showModifMdp($idUtilisateur)
    {
        $id = $_GET['id'];
        return view('admin.modificationMdpUtilisateur', compact('idUtilisateur', 'id'));
    }
    public function updateMotDePasse()
    {
        $action = 2;
        $idUtilisateur = $_POST['idUtilisateur'];
        $id = $_POST['id'];
        $mdp = $_POST['motDePasse'];
        utilisateur::where("idUtilisateur", "=", $idUtilisateur)->update(array('motDePasseUtilisateur' => Hash::make($mdp)));

        // envoi du mail
        $req = utilisateur::select('mail')->where('idUtilisateur', '=', $idUtilisateur)->get();
        $mail = explode('"', $req);
        $mail = $mail[3];
        Mail::to($mail)->send(new ChangeMDP($mdp));
        return view('admin.acceuiladmin', compact('id', 'action'));
    }

    public function listeattente()
    {
        $utilisateursFileAttente = reservation::join('utilisateurs', 'idUtilisateur', '=', 'utilisateur')->select('idReservation', 'nomUtilisateur', 'positionFileAttente')->where('positionFileAttente', '>', 0)->get();
        return view('admin.listeattente', compact('utilisateursFileAttente'));
    }

    public function listeUtilisateur()
    {
        $listeUtilisateur = utilisateur::select('idUtilisateur', 'nomUtilisateur', 'nom', 'prenom', 'mail', 'motDePasseUtilisateur', 'motDePasseOublie')->where('isAdministrateur', '=', false)->get();
        return view('admin.listeutilisateur', compact('listeUtilisateur'));
    }

    public function listereservation()
    {
        $reservNULL = 0;
        // la requete affiche toute les reservations active
        $listeHistoReservation = reservation::join('utilisateurs', 'reservations.utilisateur', '=', 'idUtilisateur')->join('parkings', 'parkings.idParking', '=', 'reservations.numeroPlace')->select('idReservation', 'positionFileAttente', 'parkings.numeroPlace AS numeroPlace', 'etatReservation', 'dateDebut', 'dateFin', 'nomUtilisateur')->where('dateFin', '>', date("Y-m-d"))->where('etatReservation', '=', 0)->orderBy('idReservation', 'desc')->get();
        if ($listeHistoReservation == "[]") {
            $reservNULL = 1;
        }
        return view('admin.listereservation', compact('listeHistoReservation', 'reservNULL'));
    }

    public function annulereservation()
    {
        $action = 3;
        $id = $_POST['id'];
        reservation::where('idReservation', '=', $_POST['idReserv'])->update(['etatReservation' => 1]);
        return view('admin.acceuiladmin', compact('action', 'id'));
    }

    public function listeplace()
    {
        $i = 0;
        $placeprise = reservation::join('parkings', 'parkings.idParking', '=',  'reservations.numeroPlace')->select('parkings.numeroPlace AS numeroPlace')->distinct()->get();
        $listeplace = parking::select('*')->get();
        foreach ($listeplace as $listeplacedata) {
            $alert[$listeplacedata->numeroPlace] = false;
            foreach ($placeprise as $placeprisedata) {
                $bool[$i] = false;
                if ($listeplacedata->numeroPlace == $placeprisedata->numeroPlace) {
                    $bool[$i] = true;
                    $alert[$listeplacedata->numeroPlace] = true;
                }
                $i++;
            }
        }
        return view('admin.listeplace', compact('listeplace', 'placeprise', 'alert'));
    }

    public function ajoutplace()
    {
        $action = 4;
        $id = $_POST['id'];
        parking::insert([
            'numeroPlace' => $_POST['numeroPlace'],
        ]);
        return view('admin.acceuiladmin', compact('id', 'action'));
    }

    public function deleteplace()
    {
        $action = 4;
        $id = $_POST['id'];
        parking::where('idParking', '=', $_POST['idParking'])->delete();
        return view('admin.acceuiladmin', compact('id', 'action'));
    }

    public function demandesinscriptions()
    {
        $id = $_GET['id'];
        $utilisateurNonInscrits = utilisateur::select('idUtilisateur', 'nomUtilisateur', 'nom', 'prenom', 'mail', 'motDePasseUtilisateur')->where('estInscrit', '=', false)->get();
        return view('admin.demandesinscriptions', compact('utilisateurNonInscrits'));
    }

    public function accepterinscription($idUtilisateur)
    {
        utilisateur::where('idUtilisateur', '=', $idUtilisateur)->update(array('estInscrit' => true));
        return back();
    }

    public function accepterToutesLesInscriptions()
    {
        utilisateur::where('estInscrit', '=', false)->update(array('estInscrit' => true));
        return back();
    }

    public function refuserinscription($idUtilisateur)
    {
        utilisateur::where('idUtilisateur', '=', $idUtilisateur)->delete();
        return back();
    }

    public function refuserToutesLesInscriptions()
    {
        utilisateur::where('estInscrit', '=', false)->delete();
        return back();
    }

    public function histoattributionplace()
    {
        $listeHistoReservation = reservation::join('utilisateurs', 'reservations.utilisateur', '=', 'idUtilisateur')->leftjoin('parkings', 'reservations.numeroPlace', '=', 'idParking')->select('idReservation', 'positionFileAttente', 'parkings.numeroPlace AS numeroPlace', 'etatReservation', 'dateDebut', 'dateFin', 'idUtilisateur', 'nomUtilisateur')->orderBy('idReservation', 'desc')->get();
        return view('admin.histoattributionplace', compact('listeHistoReservation'));
    }

    public function updateFileAttente(Request $request, $idReservation)
    {
        $action = 1;
        $id = $_POST['id'];
        $placeAattribuer = $request->input('placeAattribuer');
        $request = reservation::select('positionFileAttente')->where('idReservation', '=', $idReservation)->get();
        foreach ($request as $key => $value) {
            if ($value->positionFileAttente > $placeAattribuer)
                reservation::where('positionFileAttente', '>=', $placeAattribuer)->increment('positionFileAttente');
            else
                reservation::where('positionFileAttente', '<=', $placeAattribuer)->decrement('positionFileAttente');
        }
        reservation::where('idReservation', '=', $idReservation)->update(array('positionFileAttente' => $placeAattribuer));
        return view('admin.acceuiladmin', compact('id', 'action'));
        // return redirect()->action([admin::class, 'listeattente']);
    }

    public function show($idReservation)
    {
        $id = $_GET['id'];
        $reservation = reservation::join('utilisateurs', 'idUtilisateur', '=', 'utilisateur')->select('idReservation', 'nomUtilisateur')->where('idReservation', '=', $idReservation)->get();
        $placeAattribuer = reservation::select('positionFileAttente')->where('idReservation', '<>', $idReservation)->where('positionFileAttente', '>', 0)->orderBy('positionFileAttente')->get();
        return view('admin.modifListeAttente', compact('reservation', 'placeAattribuer'));
    }
}
