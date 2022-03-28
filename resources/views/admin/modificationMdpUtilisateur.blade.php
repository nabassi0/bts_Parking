@extends('head.admin')
@section('content')

<link rel="stylesheet" href="css\modifmdpuser.css">
<style>
    .navbar {
    background: #b7f88b86;
}

.login-form {
    width: 340px;
    margin: 50px auto;
    font-size: 15px;
}

.login-form form {
    margin-bottom: 15px;
    background: #b7f88b86;
    padding: 30px;
    border-radius: 25px;
}

.login-form h2 {
    margin: 0 0 15px;
}

.form-control,
.btn {
    min-height: 38px;
    border-radius: 2px;
}

.btn {
    font-size: 15px;
    font-weight: bold;
    background: transparent;
}
</style>

<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h2 class="text-center">Modification du mot de passe</h2>
</div>

  <div class="login-form">
    <div class="mx-auto" >
    <form action="/updateMotDePasse" method="post">
        @csrf
        <input type="hidden" name="id" value={{$_GET['id']}}>
        <input type="hidden" name="idUtilisateur" value={{$_GET['idUtilisateur']}}>

        <div class="form-group container">


            <input type="password" name="motDePasse" class="form-control" maxlength="30" placeholder="Nouveau mot de passe" required>
            <br>
            <button type="submit" class="btn btn-outline-success ">Changer le mot de passe</button>
        </div>
    </form>
</div>
</div>
@endsection
