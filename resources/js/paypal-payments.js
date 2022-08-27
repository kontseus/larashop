import './bootstrap';
import $ from 'jquery';

const headers = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Accept': 'application/json'
};

function getFields() {
    return $('#order-form').serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
}

function isEmptyFields() {
    const fields = getFields();

    for (const [_, value] of Object.entries(fields)) {
        if (value.length < 1) {
            return true;
        }
    }

    return false;
}


paypal.Buttons({
    onInit: function (data, actions) {
        if (isEmptyFields()) {
            actions.disable();
        }

        $(document).on('change', '#order-form', function () {
            if (!isEmptyFields()) {
                actions.enable();
            }
        });
    },
    onClick: function (data, actions) {
        if (isEmptyFields()) {
            alert('Please fill the form')
        }
    },
    createOrder: function (data, actions) {
        const errorClass = 'is-invalid';
        const fields = getFields();

        return $.ajax({
            url: '/paypal/order/create',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(fields),
            headers: headers,
            beforeSend: function () {
                $('.invalid-feedback').remove();
                $(`.${errorClass}`).removeClass(errorClass);
            },
            error: function (data) {
                const responseJson = data.responseJSON;
                console.log('error', responseJson)
            }
        })
            .then((order) => order.vendor_order_id)
            .catch(function (error) {
                return;
            });
    },

    // Call your server to finalize the transaction
    onApprove: function (data, actions) {
        if (data.hasOwnProperty('orderID')) {
            return fetch(`/paypal/order/${data.orderID}/capture`, {
                method: 'post',
                headers: headers
            })
                .then((res) => res.json())
                .then(function (orderData) {
                    console.log(orderData)
                });
        }
    }
}).render('#paypal-button-container');
