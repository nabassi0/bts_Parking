@extends('head.admin')
@section('content')
<link rel="stylesheet" href="css\listeattente.css">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h3 >Liste d'Attente</h3>
</div>


    <div class="container">
        <table class="table table-bordered">
            <thead>
                <th>Pseudo</th>
                <th>Position file d'attente</th>
                <th>Modifier position file d'attente</th>
            </thead>
           <tbody>
                @foreach ($utilisateursFileAttente as $value)
                <form action="modificationFileAttente/{{$value->idReservation}}" method="get">
                    <tr>
                        <td>{{$value->nomUtilisateur}}</td>
                        <td>{{$value->positionFileAttente}}</td>
                        <td><button type="submit" class="btn btn-outline-success">Modifier</button></td>
                        <input type="hidden" name="id" value={{$_POST['id']}}>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
