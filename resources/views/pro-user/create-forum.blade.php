<x-frontend.layout>
    @push('styles')
        <style>
            input.error,
            textarea.error,
            select.error {
                border-color: red !important;
            }

            label.error {
                color: red;
            }

        </style>
    @endpush
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left pt-5">
                    <!-- question heading -->
                    <div class="foorbis-question-head foorbis-announces">
                        <label><i class="fas fa-angle-left mr-2"></i> Poser une question</label>
                    </div>
                    <hr>
                    <form class="w-100" id="frmFaqAdd" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- foorbis question-res-box start -->
                        <div class="foorbis-question-res-box scrollbar">
                            <div class="Titre-Question-col">
                                <input type="text" name="question" id="question" value="" placeholder="Titre Question">
                                <p class="error mt-2" id="error_question"></p>
                            </div>
                            <!-- category-select -->
                            <div class="fr-cat">
                                <div class="category-btn d-flex align-items-center mt-3" style="border:none;">
                                    <img src="{{ asset('images/category.png') }}" class="categoryImg" alt="">
                                    <div class="form-group d-flex mb-0 justify-content-between w-100">
                                        {{-- onclick="getSelectedValue()" --}}
                                        <select class="border-0 chosen-select" id="category" name="category[]" multiple 
                                            style="width:auto;background-color: transparent;">
                                            <option value="" selected disabled hidden>Catégorie</option>
                                            @foreach ($categories as $id => $title)
                                                <option value="{{ $id }}">{{ $title }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="border-0 p-0"
                                            style="background-color: transparent;"><img
                                                src="{{ asset('images/right.png') }}" class="rightImg"
                                                alt=""></button>
                                    </div>
                                </div>
                                <div id="displaydiv1" class=""></div>
                                <p class=" error
                                    mt-2" id="error_category">
                                    </p>
                                </div>
                                <!-- category-select -->
                                <div>
                                    <textarea name="description" id="description" class="scrollbar"
                                        placeholder="Poser votre question"></textarea>
                                </div>
                                <p class="error mt-2" id="error_description"></p>
                                <div class="mt-2">
                                    <div class="add-file">
                                        <img id="blah" src="{{ asset('images/add-file.png') }}"
                                            class="mt-3">
                                        <button type="submit" class="add-file-poser">Poser</button>
                                        <input type="file" onchange="readURL(this);" name="attachment" id="attachment"
                                            value="">
                                    </div>
                                </div>
                                <p class="error mt-2" id="error_attachment"></p>
                            </div>
                            <!-- foorbis question-res-box end -->
                    </form>
                </div>
                <!-- foorbis-penal-left End -->
                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <x-pro-user.filter-faq />
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // $('#frmFaqAdd').validate({
            //     rules: {
            //         question: 'required',
            //         'category[]': 'required',
            //         description: 'required',
            //         attachment: 'required',
            //     }
            // });
            $(document).on('submit', '#frmFaqAdd', function(form) {
                form.preventDefault();
                var formData = new FormData($('#frmFaqAdd')[0]);
                $.ajax({
                    url: "{{ route('save-faq-question') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.key == 1) {
                            location.href = "{{ route('forum') }}";
                        }
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            $('#error_' + key).html(val)
                        })
                    },
                })
            });
        </script>
    @endpush
</x-frontend.layout>
