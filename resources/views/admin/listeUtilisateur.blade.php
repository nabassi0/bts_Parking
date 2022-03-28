@extends('head.admin')
@section('content')
<link rel="stylesheet" href="css\listeutilisateur.css">

<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <form action="demandesinscriptions" method="get">
        @csrf
        <input type="hidden" name="id" value={{$_POST['id']}}>

    </form>
    <h3>Liste Utilisateurs</h3>
</div>
<div class="container">
    <table class="table table-bordered">
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col" colspan="2" >Mail</th>
        <th scope="col">Mot de passe</th>
        </tr>
        @foreach ($listeUtilisateur as $listeUtilisateurdata)
        <?php $idUtilisateur = $listeUtilisateurdata->idUtilisateur; ?>
        <form action="modificationMdpUtilisateur/{{$idUtilisateur}}" method="get">
            <input type="hidden" name="id" value={{$_POST['id']}}>
            <input type="hidden" name="idUtilisateur" value={{$idUtilisateur}}>
            <tr>
                <td>{{$idUtilisateur}}</td>
                <td>{{$listeUtilisateurdata->nomUtilisateur}}</td>
                <td>{{$listeUtilisateurdata->nom}}</td>
                <td>{{$listeUtilisateurdata->prenom}}</td>
                <td colspan="2">{{$listeUtilisateurdata->mail}}</td>
                <td>
                    @if ($listeUtilisateurdata->motDePasseOublie == 0)
                        <button type="submit" class=" btn-primary">Modifier</button>
                    @else
                        <button type="submit" class=" btn-danger">Modifier</button>
                    @endif
                </td>
            </tr>
        </form>
        @endforeach
        </tbody>
    </table>
    <form action="demandesinscriptions" method="get">
        @csrf
        <input type="hidden" name="id" value={{$_POST['id']}}>
        <button type="submit" class="bouton">Voir demandes d'inscription</button>
    </form>
</div>

@endsection
