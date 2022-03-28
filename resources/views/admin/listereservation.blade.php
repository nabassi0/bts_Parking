@extends('head.admin')
@section('content')
<link rel="stylesheet" href="css\listeutilisateur.css">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h3>LISTE DES RESERVATIONS</h3>
</div>
<div class="container mb-3 mt-3">
    @if ($reservNULL == 1)
    <div class="alert alert-danger" role="alert">
        Aucune reservation n'est active
      </div>
    @else
        <table class="table">
            <thead>
                <th scope="col">Utilisateur</th>
                <th scope="col">Numero de place</th>
                <th scope="col">Date début de la réservation</th>
                <th scope="col">Date fin de la <br> réservation</th>
                <th scope="col">Annulation</th>
            </thead>
            <tbody>
                @foreach ($listeHistoReservation as $listeHistoReservationdata)
                    <tr>
                        <td>{{$listeHistoReservationdata->nomUtilisateur}}</td>
                        <td>{{$listeHistoReservationdata->numeroPlace}}</td>
                        <td>{{$listeHistoReservationdata->dateDebut}}</td>
                        <td>{{$listeHistoReservationdata->dateFin}}</td>
                        <form action="AnnuleReservation" method="post">
                            @csrf
                            <input type="hidden" name="id" value={{$_POST['id']}}>
                            <td>
                                <button type="submit" name="idReserv" class="btn btn-danger" onclick='return confirm("Êtes-vous sûr de vouloir annuler la reservation ?")' value={{$listeHistoReservationdata->idReservation}}>Annuler</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
