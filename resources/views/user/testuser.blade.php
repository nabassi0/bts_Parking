salut
<table>
    @foreach ($placesLibres as $placesLibresdata)
        <tr>
            <td>
                {{$placesLibresdata -> numeroPlace}}
            </td>
        </tr>
    @endforeach
</table>
