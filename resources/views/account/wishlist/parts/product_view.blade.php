<?php
$class = $row->price > $row->model->endPrice ? 'text-success' : 'text-danger';
?>
<tr>
    <td>
        <img src="{{ $row->model->thumbnailUrl }}" alt="{{ $row->name }}" style="width: 75px;">
    </td>
    <td>
        <a href="{{ route('products.show', $row->id) }}"><strong>{{ $row->name }}</strong></a>
    </td>
    <td>{{ $row->price }}$</td>
    <td class="{{ $class }}">{{ $row->model->endPrice }}$</td>
    <td>{{ $row->model->available ? 'Available' : 'Not Available' }}</td>
    <td>
        <form action="{{ route('wishlist.delete', $row->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Remove">
        </form>
    </td>
</tr>
