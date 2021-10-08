$(document).on('click', '.card-check', function (e) {
    var id = $(this).val();
    $.ajax({
        url: "{{ route('edit-card') }}",
        type: 'POST',
        data: {
            id: id
        },
        dataType: 'json',
        success: function (response) {
            if (response.key == 1) {
                var expire = response.data.expires_on;
                var expires_on = expire.split('/');
                $('.card-id').val(response.data.id);
                $('.card-num').val(response.data.card_number);
                $('.card-expiry-month').val(expires_on[0]);
                $('.card-expiry-year').val(expires_on[1]);
                $('.card-cvc').val(response.data.cvv);
            }
        },
    })
});