<?php

use Illuminate\Support\Facades\Log;

if (!isset($error)) {
    $error = null;
}
Log::debug($error);
?>
@extends('head.connexion')
@section('content')
<div class="login-form">
    @if ($error == 1)
        <center>
            <p class="bg-light border border-danger">
                Le nom d'utilisateur est déjà prit
            </p>
        </center>
    @elseif($error ==  2)
        <center>
            <p class="bg-light border border-danger">
                L'e-mail a déja était utilisé
            </p>
        </center>
    @elseif($error ==  3)
        <center>
            <p class="bg-light border border-danger">
                Les mots de passe ne sont pas identiques
            </p>
        </center>
    @endif
    <form action="inscriptionexe" method="get">
        <h2 class="text-center">Inscription du compte</h2>
        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="Utilisateur" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="mail" placeholder="Adresse E-Mail" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="mdp" name="password" placeholder="Mot de passe"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="newpassword" placeholder="Confirmation du mot de passe" required>
        </div>
       <!-- <select name="vehicule" id="vehicule">
    <option value="">Choisir votre type de véhicule</option>
    <option value="4x4">4x4</option>
    <option value="Moto">Moto</option>
    <option value="Voiture">Voiture</option>
    <option value="Van">Van</option>
</select>
<br></br> -->
        <div class="form-group">
            <button type="submit" class="btn btn-outline-success">Inscription</button>
        </div>
    </form>
</div>
@endsection

