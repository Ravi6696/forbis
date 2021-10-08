<x-frontend.layout>@push('styles')
    <style>
        label.error {
            color: red;
        }

        .foorbis-question-res-box {
            margin-top: 2rem;
        }

        .foorbis-question-res-box textarea {
            height: 0px !important;
        }

        .qb-slide {
            width: 100%;
        }
    </style>
    @endpush
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left ">
                    <!-- question heading -->
                    <div class="foorbis-question-head foorbis-announces">
                        <label>{{ $faqs->count() }} Questions</label>
                    </div>
                    <hr>

                    <!-- foorbis question-res-box start -->
                    <button class="loadLess">Load Less</button>
                    <div class="faqList"></div>
                    <button class="loadMore">Load More</button>
                    <!-- foorbis question-res-box end -->
                </div>
                <!-- foorbis-penal-left ENd -->


                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right filter-faqs">
                    <x-pro-user.filter-faq />
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).on("scroll", function() {
                console.log('hello');
            });
            $(document).ready(function() {
                var page = 1;
                load_more(page);
                filterForums();

                $(document).on('click', '.btnFav', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('add-faq-favourite') }}",
                        type: 'POST',
                        data: {
                            _token : "{{csrf_token()}}",
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                load_more(page);
                                filterForums();
                            }
                        },
                    })
                });
                $(document).on('submit', '.frmAnsFaq', function(form) {
                    var id = $(this).data('id');
                    form.preventDefault();
                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        url: "{{ route('save-faq-answer') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                load_more(page);
                            }
                        },
                    })
                });
                $(document).on('click', '.loadMore', function(e) {
                    page++;
                    load_more(page);
                    document.documentElement.scrollTop = 0;
                });
                $(document).on('click', '.loadLess', function(e) {
                    page--;
                    load_more(page);
                });
                $(document).on('click', '.refresh-btn', function(e) {
                    $('#search_filter').val(null);
                    $('#categories_filter').val(null);
                    load_more(page);
                });
                $(document).on('keyup', '#search_filter', function(e) {
                    load_more(page);
                    // filterForums();
                });
                $(document).on('change', '#categories_filter', function(e) {
                    // filterForums();
                    load_more(page);
                });
                $(document).on('keyup', '#filterSearch', function(e) {
                    filterForums();
                });

                function filterForums() {
                    var search_filter = $('#filterSearch').val();
                    var categories = $('#categories_filter').val();
                    $.ajax({
                        url: "{{ route('filter-forums') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'search_filter': search_filter,
                            'categories': categories,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $(".filter-faqs").html(response.data);
                        },
                    })
                }

                function load_more(page) {
                    var search_filter = $('#search_filter').val();
                    var categories = $('#categories_filter').val();
                    $.ajax({
                        url: "{{ route('get-faqs-list') }}?page=" + page,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'search_filter': search_filter,
                            'categories': categories,
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.key == 1) {
                                $('.faqList').html(response.data.html);
                                if (response.data.faqs.next_page_url == null) {
                                    $('.loadMore').hide();
                                } else {
                                    $('.loadMore').show();
                                }
                                if (response.data.faqs.prev_page_url == null) {
                                    $('.loadLess').hide();
                                } else {
                                    $('.loadLess').show();
                                }
                            }
                        },
                    })
                }
            });
    </script>
    @endpush
</x-frontend.layout>
