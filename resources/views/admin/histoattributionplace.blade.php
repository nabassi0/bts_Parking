@extends('head.admin')
@section('content')
<link rel="stylesheet" href="css/histoattributions.css">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h3>Historique de reservations</h3>
</div>
<div class="container">
        <table class="table table-bordered">
            <thead>
           <th scope="col">Id réservation</th>
           <th scope="col">Position file d'attente</th>
           <th scope="col">Numero place attribuée</th>
           <th scope="col">Utilisateur</th>
           <th scope="col">Etat réservation</th>
           <th scope="col">Date début de la réservation</th>
           <th scope="col">Date fin de la réservation</th>
        </thead>
        <tbody>
            @foreach ($listeHistoReservation as $listeHistoReservationdata)
            <tr>
                <td>{{$listeHistoReservationdata->idReservation}}</td>
                <td>{{$listeHistoReservationdata->positionFileAttente}}</td>
                <td>{{$listeHistoReservationdata->numeroPlace}}</td>
                <td>{{$listeHistoReservationdata->nomUtilisateur}}</td>
                <td>
                    @if ($listeHistoReservationdata -> etatReservation == 1)
                        Annulée
                    @elseif($listeHistoReservationdata -> dateFin < date("Y-m-d"))
                        Expirée
                    @elseif($listeHistoReservationdata -> dateDebut == NULL)
                        En attente
                    @else
                        Validée
                    @endif
                </td>
                <td>{{$listeHistoReservationdata->dateDebut}}</td>
                <td>{{$listeHistoReservationdata->dateFin}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
