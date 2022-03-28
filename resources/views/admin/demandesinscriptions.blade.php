@extends('head.admin')
@section('content')
<link rel="stylesheet" href="css\demandesinscriptions.css">

<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="container mb-3 mt-3">
    <h3>Demandes d'Inscriptions</h3>
    <br><br>

    <a href = "toutaccepter" class="bouton1">Accepter toutes les inscriptions </a>
    <a href = "toutrefuser" class="bouton2">Refuser toutes les inscriptions </a>
<br><br>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="9">Liste D'attente</th>
                </tr>
                <tr>
                    <th scope="col">Id utilisateur</th>
                    <th scope="col">Pseudonyme</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Accepter</th>
                    <th scope="col">Refuser </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utilisateurNonInscrits as $value)
                    <tr>
                        <td>{{$value->idUtilisateur}}</td>
                        <td>{{$value->nomUtilisateur}}</td>
                        <td>{{$value->nom}}</td>
                        <td>{{$value->prenom}}</td>
                        <td>{{$value->mail}}</td>
                        <td><a class="bouton1" href="accepterInscription/{{$value->idUtilisateur}}">Accepter</td>
                        <td><a class="bouton2" href="refuserInscription/{{$value->idUtilisateur}}">Refuser</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
