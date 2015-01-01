<table class="table table-condensed table-bordered">
    <tr>
        <td>Imagen</td>
        <td>Usuario</td>
        <td>Comentario</td>
        <td class="col-xs-5">Fecha</td>
    </tr>
    @foreach($reviews as $review)
        <tr>
            <td>@include('layouts.partials.avatar_square',['user'=>$review->user])
            </td>
            <td>
                {{ $review->user->fullName() }}
            </td>
            <td>{{ $review->comment }}</td>
            <td>
                <span class="text-muted">{{ ucfirst($review->created_at->diffForHumans()) }}: {{  $review->created_at }}</span>
            </td>
        </tr>
    @endforeach
</table>
{{ $reviews->links() }}