<x-frontend.layout>
    @push('styles')
    <style>
        .cate-btn.active {
            background-color: #E8D9F9;
        }
    </style>
    @endpush
    <!-- foorbis-sidebar-end -->
    <div class="foorbis-penal scrollbar  admin-foorbis-col" id="foorbis-penal">
        <div class="foorbis-penal-all scrollbar">

            <div class="row pt-3">
                <!-- left -->
                <div class="col-md-8 over-actualites">
                    <div class="foorbis-question-head foorbis-announces" style="overflow: hidden;">
                        <label></i>Actualités</label>
                        @if (auth()->user()->hasRole('admin'))
                        <a href="{{route('admin.create-actualities')}}" class="btn parpal-btn add-creer-btn"><img
                                class="plusImg mr-3" src="{{ asset('images/plus-round.png')}}" alt=""
                                style="width: 25px;;">Créer une Article</a>
                        @endif
                    </div>
                    <hr>
                    <div class="blog-scrollbar scrollbar  pr-4 blog-list"></div>
                </div>
                <!-- right -->
                <div class="col-md-4">
                    <div class="right-side-panel">
                        <div class="serach-input-panel d-flex align-items-center">
                            <img src="{{asset('images/search-icon.png')}}" class="mx-3" width="18px" height="18px"
                                alt="">
                            <input type="text" id="search_filter" name="search_filter"
                                class="my-0 bg-transparent border-0" placeholder="Recherche">
                        </div>
                        <div class="line-hr my-4"></div>
                        <div class="mb-4">
                            <h4 class="text-primary">Articles récent</h4>
                        </div>
                        <div class="recent-blog-list"></div>
                        <div class="card-text mt-4">
                            <div>
                                <h5 class="mb-4 text-primary">
                                    Catégories
                                </h5>
                                @foreach ($categories as $item)
                                <div class="cate-btn mb-3" data-id="{{$item->id}}">{{$item->title}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var category_id = null;
        function getBlogList() {
            var search_filter = $('#search_filter').val();
            $.ajax({
                url: "{{ route('list-actualities') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'search_filter': search_filter,
                    'category_id': category_id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.key == 1) {
                        $('.blog-list').html(response.data.html);
                    }
                }
            })
            $.ajax({
                url: "{{ route('list-actualities-recent') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'search_filter': search_filter,
                    'category_id': category_id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.key == 1) {
                        $('.recent-blog-list').html(response.data.html);
                    }
                }
            })
        }
        $(document).ready(function() {
            getBlogList();
            $(document).on('click', '.cate-btn', function(e) {
                category_id  = $(this).data('id');
                $('.cate-btn').removeClass('active');
                $(this).toggleClass('active');
                getBlogList();
            });
            $(document).on('keyup', '#search_filter', function(e) {
                getBlogList();
            });
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
                        toastr.success(response.message);
                        if (response.key == 1) {
                            // location.href = "{{ route('forum') }}";
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

        })
    </script>
    @endpush
</x-frontend.layout>