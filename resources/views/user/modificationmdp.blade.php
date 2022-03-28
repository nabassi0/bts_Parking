<?php $error = 0 ?>
@if (isset($_POST['error']))
    <?php $error = $_POST['error'] ?>
@endif
<?php Log::debug($error); ?>
@extends('head.user')

@section('content')
<link rel="stylesheet" href="css\modifmdp.css">

<div class="login-form">
    @if ($error == 1)
        <p class="bg-light border border-danger">
            Mot de passe incorrect
        </p>
    @elseif($error == 2)
        <p class="bg-light border border-primary">
            Mot de passe changer
        </p>
    @endif
    <div class="container">
    <form action="ModificationConfirmation" method="post">
        @csrf
        <input type="hidden" name="iduser" value={{$info[0]}}>
        <h2 class="text-center">Modification du mot de passe</h2>
        <div class="form-group">

            <input type="password" name="old" class="form-control" placeholder="Mot de passe actuel" required>
        </div>
        <div class="form-group">

            <input type="password" name="new" class="form-control" placeholder="Nouveau mot de passe" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-success ">Changer le mot de passe</button>
        </div>
    </form>
</div>
@endsection
