<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@switch($action)
    @case(1)
    <form action="/ListeAttente" name="form" method="post">
        @csrf
        <input type="hidden" name='id' value={{$id}}>
    </form>
    <script type="text/javascript">
        document.forms["form"].submit();
    </script>
        @break
    @case(2)
    <form action="/ListeUtilisateur" name="form" method="post">
        @csrf
        <input type="hidden" name='id' value={{$id}}>
    </form>
    <script type="text/javascript">
        document.forms["form"].submit();
    </script>
        @break
        @case(3)
        <form action="/ListeReservation" name="form" method="post">
            @csrf
            <input type="hidden" name='id' value={{$id}}>
        </form>
        <script type="text/javascript">
            document.forms["form"].submit();
        </script>
            @break
        @case(4)
        <form action="/ListePlace" name="form" method="post">
            @csrf
            <input type="hidden" name='id' value={{$id}}>
        </form>
        <script type="text/javascript">
            document.forms["form"].submit();
        </script>
            @break
    @default

@endswitch

<script type="text/javascript">
    document.forms["form"].submit();
</script>
