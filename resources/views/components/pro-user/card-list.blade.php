<div>
    @push('styles')
    <style>
        .error {
            color: red;
        }
    </style>
    @endpush
    @foreach ($cardDetails as $item)
    <div class="table-responsive scrollbar">
        <table class="table">
            <thead class="foorbis-table bg-sub-color">
                <tr class="border-0">
                    <th scope="col-3">
                        <img src="{{ asset('images/mastercard.png') }}" alt="">
                    </th>
                    <th scope="col-3">Se terminant par ... {{ substr($item->card_number, -4) }}</th>
                    <th scope="col-3">Expire le {{ $item->expires_on }}</th>
                    <th scope="col-3">
                        <p class="mb-0 text-primary updateCardInfo" id="updateCard" data-toggle="modal"
                            data-target="#exampleModal" data-id="{{ $item->id }}"> metter a jour</p>
                    </th>
                    <th scope="col-3">
                        <p class="mb-0 text-primary deleteCardInfo" data-id="{{ $item->id }}">Suppimer</p>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    @endforeach
</div>
