<?php
if (!isset($error)) {
    $error = null;
}
Log::debug($error);
?>
@extends('head.connexion')
@section('content')
<div class="login-form">
    @if ($error == 2)
    <center>
        <p class="bg-light border border-danger">
            E-mail non reconnu
        </p>
    </center>
    @endif
    <form action="oublie" method="get">
        <h2 class="text-center">Mot de passe oublié ?</h2>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="email" id="email" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Réinitialisation</button>
        </div>
    </form>
</div>
@endsection
