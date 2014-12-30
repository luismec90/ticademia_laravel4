<table class="table table-condensed table-bordered">
    <tr>
        <td>Comentarios</td>
        <td>Valoración</td>
        <td class="col-xs-5">Usuario</td>
    </tr>
    @foreach($reviews as $review)
        <tr>
            <td>{{ $review->comment }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->user->fullName() }}
            <br>
                <span class="text-muted">{{ ucfirst($review->created_at->diffForHumans()) }}: {{  $review->created_at }}</span>
            </td>
        </tr>
    @endforeach
</table>
{{ $reviews->links() }}