<?php
$reserv = $dbreserv[1];
$today = date("Y-m-d");
Log::debug($today);
$annule = 0;
$valide = 0;
?>
@extends('head.user')
@section('content')
<link rel="stylesheet" href="css\reservation.css">
    <h2 class="h2"> Vos Réservations </h2>

<br>
@if ($dbreserv[0] == 0)
<div class="container mb-3 mt-3">
    <table class="table table-bordered">
        <thead>
            <th scope="col">Réservation N°</th>
            <th scope="col">File d'attente</th>
            <th scope="col">Numéro de place</th>
            <th scope="col">Début Date Réservation</th>
            <th scope="col">Date limite</th>
            <th scope="col">Etat de la reservation</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            @foreach ($reserv as $reservdata)
            <?php
            $annule = 0;
            $valide = 0;
            ?>
            <tr>
                <td>
                    {{$reservdata -> idReservation}}
                </td>
                <td>
                    {{$reservdata -> positionFileAttente}}
                </td>
                <td>
                    {{$reservdata -> numeroPlace}}
                </td>
                <td>
                    {{$reservdata -> dateDebut}}
                </td>
                <td>
                    {{$reservdata -> dateFin}}
                </td>
                <td>
                    @if ($reservdata -> etatReservation == 1)
                        Annulée
                        <?php $annule = 1 ?>
                        <?php $valide = 1 ?>
                    @elseif($reservdata -> dateDebut == NULL)
                        En attente
                        <?php $annule = 1 ?>
                    @elseif($reservdata -> dateFin < $today)
                        Expirée
                        <?php $annule = 1 ?>
                        <?php $valide = 1 ?>
                    @else
                        Validée
                    @endif
                </td>
                <td>
                    <form action="annuler" method="post">
                        @csrf
                        <input type="hidden" name="iduser" value={{$info[0]}}>
                        <input type="hidden" name="action" value="1">
                        @if ($annule == 0)
                        <button type="submit" value={{$reservdata -> idReservation}}
                            onclick='return confirm("Êtes-vous sûr de vouloir annuler la reservation ?")' name="id"
                            class="btn-danger">Annuler</button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<h2 class="h2"> Aucune réservation effectuée </h2>
@endif
<?php Log::debug($annule); ?>
@if ($valide == 1 || $dbreserv[0] != 0)
    <form action="ReservationExe" method="post">
        @csrf
        <input type="hidden" name="iduser" value={{$info[0]}}>
        <div class="container mb-3 mt-3">
            <p class="text-center">
                <button type="submit" class="btn-success">Faire une réservation</button>
            </p>
        </div>
    </form>
@endif
@endsection
