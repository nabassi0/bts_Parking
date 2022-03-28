<link rel="stylesheet" href="css\accueil.css">

<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@switch($action)
    @case(1)
    <form action="VosReservation" name="form" method="post">
        @csrf
        <input type="hidden" name='id' value={{$id}}>
    </form>
    <script type="text/javascript">
        document.forms["form"].submit();

    </script>
        @break
    @case(2)
    <form action="ModificationMDP" name="form" method="post">
        @csrf
        <input type="hidden" name="error" value={{$user[1]}}>
        <input type="hidden" name='id' value={{$user[0]}}>
    </form>
    <script type="text/javascript">
        document.forms["form"].submit();
    </script>
        @break
    @default

@endswitch
