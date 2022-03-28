<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav-admin.css">
    <title>Parking</title>


</head>

<body>
    <?php
    $adresse = $_SERVER['PHP_SELF'];
    $adresse = explode("/", $adresse);
    $adresse = $adresse[2];
    Log::debug($adresse);
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    Log::debug($id);
    ?>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <h3 class="navbar-brand">Administration</h3>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">

            <form action="/ListeAttente" method="post">
                @csrf
                <input type="hidden" name="id" value={{$id}}>
                    <button type="submit" class="btn">Liste d'attente</button>
            </form>

            <form action="/ListeUtilisateur" method="post">
                @csrf
                <input type="hidden" name="id" value={{$id}}>
                    <button type="submit"  class="btn">Liste des utilisateurs</button>
            </form>

            <form action="/ListePlace" method="post">
                @csrf
                <input type="hidden" name="id" value={{$id}}>
                    <button type="submit" class="btn">Liste des Places</button>
            </form>

            <form action="/ListeReservation" method="post">
                @csrf
                <input type="hidden" name="id" value={{$id}}>
                    <button type="submit" class="btn">Liste des reservations</button>
            </form>

            <form action="/HistoAttributionPlace" method="post">
                @csrf
                <input type="hidden" name="id" value={{$id}}>
                    <button type="submit"  class="btn">Historique attribution des places</button>
            </form>

          </div>

          <span class="navbar-text">
            <span class="navbar-text"><a href="/">Deconnexion</a></span>
          </span>

      </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>
