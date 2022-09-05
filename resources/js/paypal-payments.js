import './bootstrap';
import $ from 'jquery';
// import './iziToast'

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
                onsole.log('responseJson', responseJson);
                if (typeof responseJson !== 'undefined') {
                    let errorTemplate = `<span class="invalid-feedback d-inline" role="alert">
                                        <strong>___</strong>
                                    </span>`;

                    for (let [field, message] of Object.entries(responseJson.errors)) {
                        let $input = $(`input[name="${field}"]`);
                        $input.after(errorTemplate.replace('___', message[0]));
                    }
                }
            }
        }).then((order) => order.vendor_order_id)
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
                .catch(function (orderData) {
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart();
                    }

                    if (errorDetail) {
                        let iziToastOpts = {
                            title: 'Sorry, your transaction could not be processed.',
                            position: 'topCenter'
                        };

                        if (errorDetail.description) {
                            iziToastOpts['message'] = errorDetail.description;
                        }

                        iziToast.error(iziToastOpts);
                        return false;
                    }

                    // iziToast.success({
                    //     title: 'Payment process was successfully done!',
                    //     position: 'topCenter',
                    //     onClosing: () => { window.location.href = `/paypal/order/${orderData.orderId}/thankyou` }
                    // });
                });
        }
    }
}).render('#paypal-button-container');
