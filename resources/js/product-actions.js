import './bootstrap';
import $ from 'jquery';

$(document).ready(function (e) {
    $(document).on('change', '.star', function () {
        $(this).parents('.poststars').submit();
    });

    $(document).on('click', '.reply', function(e) {
        e.preventDefault();

        $(this).parent().find('form').removeClass('d-none');
    });
});
