@extends('head.admin')
@section('content')
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h3 align="center" style="color:#00DFF9" ;>MODIFICATION DE LA LISTE D'ATTENTE</h3>
</div>
<br>

@foreach ($reservation as $reservationdata)
<?php $positionFileAttente = $reservationdata->positionFileAttente ?>
<?php $idReservation = $reservationdata->idReservation ?>
<div class="container mb-3 mt-3">
    <center>
        <h3> Modification de la position dans la liste attente : {{$reservationdata->nomUtilisateur}}</h3>
    </center>
    <form method="POST" action="updateFileAttente/{{$idReservation}}">
        @csrf
        <br>
        @endforeach
        <center>Nouvelle place de file d'attente à attribué:
            <select name="placeAattribuer">
                @foreach($placeAattribuer as $value)
                <option value="{{$value->positionFileAttente}}">{{$value->positionFileAttente}}</option>
                @endforeach
            </select>
        </center>
        <br><br><br>
        <input type="hidden" name="id" value={{$_GET['id']}}>
        <div style="text-align: right">
            <button type="submit" class="btn btn-primary" value="valider">Valider</button>
        </div>
    </form>
</div>
@endsection
