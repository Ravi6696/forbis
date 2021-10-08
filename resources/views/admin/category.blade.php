<x-frontend.layout>
    <div class="foorbis-penal scrollbar admin-categories-col" id="foorbis-penal">
        <div class="pt-5">
            <div class="foorbis-penal-all ">
                <div class="foorbis-question-head foorbis-announces mb-3 ml-2">
                    <label class="text-uppercase categories-title"
                        style="font-weight:500;color: #C2C2C2;font-size: 20px;"> Categories</label>
                </div>
                <div class="row categoryList">
                </div>
            </div>
            <div class="createPopup" id="createPopup">
                <div class="card" id="popupCard">
                    <div class="header">
                        <p>
                            Nouvelle Annonce
                        </p>
                        <img src="{{ asset('images/close-icon.png')}}" class="closePopup" id="closePopup" alt="">
                    </div>
                    <hr>
                    <p class="detail">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut lectus porta
                        gravida. Nunc
                        sit amet tellus imperdiet, dapibus nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis
                        molestie
                        congue ante sed porta. Fusce mauris
                        felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem magna, tristique ut leo
                        at, dapibus
                        rhoncus arcu. Fusce ultricies
                        varius congue. Aliquam quis varius mauris. Suspendisse id placerat justo, commodo
                        pellentesque massa.
                    </p>
                    <div class="date">
                        <div class="left">
                            <p>
                                Nouvelle annonce : <span> numéro 08</span>
                            </p>
                        </div>
                        <div class="right">
                            <p>
                                Date de création | Prochain renouvellement
                            </p>
                        </div>
                    </div>
                    <div class="transaction">
                        <div class="left">
                            <p class="title">
                                VOTRE SOLDE ACTUEL
                            </p>
                            <p class="amount">
                                35 EURO
                            </p>
                        </div>
                        <div class="center">
                            <img src="{{ asset('images/right-aero.png')}}" alt="">
                        </div>
                        <div class="right">
                            <p class="title">
                                VOTRE NOUVEAU SOLDE
                            </p>
                            <p class="amount">
                                40 EURO
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="methods">
                        <p class="left">
                            Moyens de paiement
                        </p>
                        <div class="right">
                            <img src="{{ asset('images/plus_Purple.png')}}" alt="">
                            Ajouter un nouveau
                        </div>
                    </div>
                    <div class="masterCard">
                        <div class="image">
                            <img src="{{ asset('images/mastercard.png')}}" alt="">
                        </div>
                        <div class="number">
                            <p>
                                Se terminant par ... 0000
                            </p>
                        </div>
                        <div class="expiry">
                            <p>
                                Expire le 01/23
                            </p>
                        </div>
                        <div class="name">
                            <p>
                                mettre à jour
                            </p>
                        </div>
                        <div class="status">
                            <p>
                                Supprimer
                            </p>
                        </div>
                    </div>
                    <div class="condition">
                        <div class="left">
                            <input type="checkbox" id="conditions">
                            J'accepte les conditions générales de ventes
                        </div>
                        <div class="right">
                            <a href="" class="foorbis-btn submitBtn">
                                Commander
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function getCategoryList() {
            $.ajax({
                url: "{{ route('admin.category-list') }}",
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.key == 1) {
                        $('.categoryList').html(response.data.html);
                    }
                }
            })
        }
        $(document).ready(function() {
            getCategoryList();
            $(document).on('click','.creer-btn',function (e) {
                e.preventDefault();
                $('.error').html('');
                // create or update category
                var id = $(this).data('id');
                var title = $('#title'+id).val();
                var that = $(this);
                $.ajax({
                    url: "{{ route('admin.save-category') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        title: title,
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message);
                            getCategoryList();
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            that.parent().parent().find('.error_' + key).html(val);
                        })
                    },
                })
            });
        });
    </script>
    @endpush
</x-frontend.layout>
