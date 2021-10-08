<x-frontend.layout>
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row pt-4">
                <!-- foorbis-penal-left start -->
                <div class="col-md-8 pr-1 blog-scrollbar scrollbar" data-spy="scroll" data-target="#ListScrollSpy"
                    data-offset="0">
                    <div class="foorbis-question-head foorbis-announces">
                        <a href="{{route('actualities')}}"><i class="fas fa-angle-left mr-2"></i> Detaill offre
                            demplon</a>
                    </div>
                    <hr>
                    <div class="foorbis-penal-right w-100 pt-3">
                        <!-- blog-top-col -->
                        <div class="card">
                            <!-- blog-img -->
                            <div class="foorbis-blog-img">
                                <img src="{{$blog->attachment_path??null}}" alt="">
                            </div>

                            <!-- blog-information -->
                            <div class="lower blog-info-col">
                                <div class="title-que">
                                    <div class="tq-left">
                                        <h4 class="blog-title-col">{{$blog->title ??'-'}}
                                        </h4>
                                    </div>
                                    <div class="subtitle">
                                        <p>
                                            <span>{{$blog->user->full_name ?? '-'}} </span>le <span
                                                class="text-primary">{{$blog->created_at->diffForhumans()}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="blog-info">
                                    {{-- <p>
                                        {{$blog->sub_title}}
                                    </p> --}}
                                    <div class="title-que">
                                        <div class="tq-left text-color">
                                            <h4 class="blog-title-col">{{$blog->sub_title??'-'}}
                                            </h4>
                                        </div>

                                    </div>
                                    <p>{{$blog->content??'-'}}
                                    </p>

                                </div>

                                <!-- social-icon -->
                                <div class="cardFooter blog-social-icon">
                                    <div class="d-flex responive-d-flex">
                                        <div class="btnbox mr-5">
                                            <a href="">
                                                <img src="{{asset('images/share.png')}}" alt="">
                                                Partager
                                            </a>
                                        </div>
                                        <div class="btnbox">
                                            <a href="">
                                                <img src="{{asset('images/editor.png')}}" alt="">
                                                Editer
                                            </a>
                                        </div>
                                    </div>
                                    <div class="social">
                                        <div class="box fb">
                                            <a href="">
                                                <img src="{{asset('images/fb.png')}}" alt="">
                                            </a>
                                            12
                                        </div>
                                        <div class="box insta">
                                            <a href="">
                                                <img src="{{asset('images/insta.png')}}" alt="">
                                            </a>
                                            15
                                        </div>
                                        <div class="box twitter">
                                            <a href="">
                                                <img src="{{asset('images/twiter.png')}}" alt="">
                                            </a>
                                            24
                                        </div>
                                        <div class="box linkedin">
                                            <a href="">
                                                <img src="{{asset('images/linkdin.png')}}" alt="">
                                            </a>
                                            35
                                        </div>
                                    </div>
                                </div>

                                <!-- blog-comment-section -->
                                <div class="comment-box blog-comment-box">

                                </div>
                            </div>
                        </div>
                        <!-- blog-top-col-end -->

                        <!-- blog-commnet-col -->
                        <div class="blog-vote-resp-box vote-resp-box bg-white mt-5">
                            <!-- title start -->
                            <div class="vrb-title pt-2 pl-2">
                                <h4>Votre réponse</h4>
                            </div>
                            <hr>
                            <!-- title end -->

                            <!-- write response start -->
                            <div class="write-response">
                                <div class="qb-slide " style="width: -webkit-fill-available;">
                                    <div class="qb-img-opt">
                                        <!-- image start -->
                                        <div class="wr-img d-block">
                                            <img src="{{auth()->user()->profile_path??null}}" alt="">
                                        </div>
                                        <!-- image end -->
                                    </div>
                                    <div class="qb-col">
                                        <form action="">
                                            <textarea id="comment" rows="6" class="w-100 wr-textarea"
                                                style="border: 1px solid #C2C2C2;border-radius:10px;"></textarea>
                                            <a class="foorbis-btn d-inline-block mt-3 wr-btn btn-respond">Poser votre
                                                réponse</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- write response end -->
                        </div>
                        <!-- blog-comment-col-end -->
                    </div>
                </div>
                <!-- foorbis-penal-left end -->


                <!-- foorbis-penal-right start -->
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
                                <div class="cate-btn mb-3">{{$item->title}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>

    </div>@push('scripts')
    <script>
        function getBlogList() {
            var search_filter = $('#search_filter').val();
            $.ajax({
                url: "{{ route('list-actualities') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'search_filter': search_filter,
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
                },
                dataType: 'json',
                success: function(response) {
                    if (response.key == 1) {
                        $('.recent-blog-list').html(response.data.html);
                    }
                }
            })
        }
        function getCommentList() {
            $.ajax({
                url: "{{ route('list-actualities-comment',$blog->id) }}",
                type: 'GET',
                dataType: 'json',
                processData:false,
                contentType:false,
                success: function(response) {
                    if (response.key == 1) {
                        $('.blog-comment-box').html(response.data.html);
                    }
                }
            })
        }
        $(document).ready(function() {
            getBlogList();
            getCommentList();
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
            $(document).on('click', '.btn-respond', function(e) {
                    var message = $('#comment').val();
                    var blog_id = "{{ $blog->id ?? null }}";
                    $.ajax({
                        url: "{{ route('save-actualities-comment') }}",
                        type: 'POST',
                        data: {
                            'message': message,
                            'blog_id': blog_id
                        },
                        dataType: 'json',
                        // processData: false,
                        // contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#comment').val('');
                            getCommentList();
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
