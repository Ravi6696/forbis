@foreach ($cardDetails as $item)
<div class="masterCard-item-check">
    <div class="checkbox-Raison checkbox">
        <input type="checkbox" id="masterCard-check{{ $item->id }}" class="mr-2 card-check" value="{{ $item->id }}">
        <label for="masterCard-check{{ $item->id }}"></label>
    </div>

    <div class="masterCard">
        <div class="image">
            <img src="{{ asset('images/mastercard.png') }}" alt="">
        </div>
        <div class="number">
            <p>
                Se terminant par ... {{ substr($item->card_number, -4) }}
            </p>
        </div>
        <div class="expiry">
            <p>
                Expire le {{ $item->expires_on }}
            </p>
        </div>
        <div class="name">
            <p class="mb-0 text-primary update-card" id="updateCard" onclick="$('#stripePayment').removeClass('hidden'); $('.error').html('')"
                data-id="{{ $item->id }}"> metter a jour</p>
        </div>
        <div class="status">
            <p class="mb-0 text-primary delete-card" data-id="{{ $item->id }}">
                Suppimer</p>
        </div>
    </div>
</div>
@endforeach