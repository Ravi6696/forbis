<x-frontend.layout>
    @push('styles')
    <style>
        .error {
            color: red;
        }

        .cate-btn.active {
            background-color: #E8D9F9;
        }
    </style>
    @endpush
    <div class="foorbis-penal scrollbar admin-foorbis-col" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row pt-4">
                <!-- foorbis-penal-left start -->
                <div class="col-md-8 pr-1 blog-scrollbar scrollbar" data-spy="scroll" data-target="#ListScrollSpy"
                    data-offset="0">
                    <div class="foorbis-penal-right w-100 pt-3">
                        <div class="foorbis-question-head foorbis-announces">
                            <label class="mb-0"><i class="fas fa-angle-left mr-2"></i>Actualités</label>
                        </div>
                        <hr>

                        <!-- blog-top-col -->
                        <div class="mt-4">
                            <form enctype="multipart/form-data" id="frmBlogAdd" method="post">
                                @csrf
                                <!-- blog-img -->
                                <div class="pink-imginput-btn p-1" style="top:100px;width:190px;">
                                    <input id="btn-input" type="file" name="attachment" onchange="loadFile(event)">
                                    <p><img src="{{ asset('images/img-icon.png')}}" class="img-icon"><a
                                            href="#">Nouvelles
                                            images</a></p>
                                </div>
                                <div class="foorbis-blog-img">
                                    <img id="blah" src="{{ asset('images/sign-in-left.jpg')}}" alt="">
                                </div>

                                <div class="mt-4 admin-actualite-col">
                                    <div class="card blog-info-col mb-3">
                                        {{-- <h4 class="blog-title-col py-3" style="margin: 0px !important;">Title article</h4> --}}
                                        <input type="text" name="title" id="title" value="">
                                        <p class="error error_title"></p>
                                    </div>
                                    <b><textarea class="card p-3 scrollbar mb-3" name="sub_title" id="sub_title"
                                            placeholder="Texte article"></textarea></b>
                                    <p class="error error_sub_title"></p>
                                    <p class="error error_category"></p>
                                    <div class="subtitle mb-3"
                                        style="display: flex;flex-wrap: wrap;justify-content:space-between;">
                                        <p>Par
                                            <span>Foorbis</span>
                                            le
                                            <span style="color:#6500D3;">date</span>
                                        </p>
                                        <span class="text-right">
                                            <button class="nav-link parpal-btn float-right text-center" type="submit"
                                                style="width:170px;">Creer</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- blog-top-col-end -->
                    </div>
                </div>
                <!-- foorbis-penal-left end -->


                <!-- foorbis-penal-right start -->
                <div class="col-md-4">
                    <div class="right-side-panel">
                        <div class="serach-input-panel d-flex align-items-center">
                            <img src="{{ asset('images/search-icon.png')}}" class="mx-3" width="18px" height="18px"
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
                                <p class="error error_category"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        // $('#frmBlogAdd').validate({
    //     rules: {
    //         title: 'required',
    //         sub_title: "required",
    //     }
    // });
    var loadFile = function(event) {
        var image = document.getElementById('blah');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function getRecentBlogList() {
        var search_filter = $('#search_filter').val();
        $.ajax({
            url: "{{ route('list-actualities-recent') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'search_filter': search_filter,
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
        var category_id = '';
        getRecentBlogList();
        $(document).on('keyup', '#search_filter', function(e) {
            getRecentBlogList();
        });
        $(document).on('click', '.cate-btn', function(e) {
            category_id  = $(this).data('id');
            $('.cate-btn').removeClass('active');
            $(this).toggleClass('active');
        });
        $(document).on('submit', '#frmBlogAdd', function(form) {
            form.preventDefault();
            var formData = new FormData($('#frmBlogAdd')[0]);
            formData.append('category',category_id);
            $.ajax({
                url: "{{ route('admin.save-actualities') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    if (response.key == 1) {
                        getRecentBlogList();
                        location.href = "{{route('actualities')}}";
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(key, val) {
                        $('.error_' + key).html(val)
                    })
                },

            })
            form.stopImmediatePropagation();
        });
    });
    </script>
    @endpush
</x-frontend.layout>
