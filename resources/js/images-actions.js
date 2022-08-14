import './bootstrap';
import $ from 'jquery';

$(document).on('click', '.remove-product-image', function(e) {
    e.preventDefault();
    let $btn = $(this);

    $.ajax({
        url: $btn.data('route'),
        type: 'DELETE',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log('data', data);
            $btn.parent().remove();
        },
        error: function(data) {
            console.log('Error: ', data);
        }
    });

});
