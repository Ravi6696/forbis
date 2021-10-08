@foreach ($faqs as $key => $faq)
<div class="foorbis-question-res-box scrollbar">
    <!-- question resp start -->
    <div class="question-box bg-white">
        <!-- question section start -->
        <div class="qb-slide qb-upper-slide">
            <div class="qb-img-opt ">
                <div class="que-opts h-100">

                    <!-- image start -->
                    <div class="opt-img d-block">
                        <img src="{{ $faq->attachment_url ?? '' }}" alt="">
                    </div>
                    <!-- image end -->

                    <!-- rating start -->
                    <div class="opt-rating ">
                        <img src="{{ asset('images/que-rate.png') }}" class="que-opt-icon" alt="">
                        <span class="d-block mt-1 rateCount"
                            style="color: #FF6E92;">{{ $faq->faqFavourite->count() ?? 0 }}</span>
                    </div>
                    <!-- rating end -->

                    <!-- comment start -->
                    <div class="opt-comment">
                        <img src="{{ asset('images/que-comment.png') }}" class="que-opt-icon" alt="">
                        <span class="d-block mt-1 commentCount"
                            style="color: #7114D6;">{{ $faq->faqAnswer->count() ?? 0 }}</span>
                    </div>
                    <!-- comment end -->

                    <!-- share start -->
                    <div class="opt-share">
                        <img src="{{ asset('images/que-share.png') }}" class="que-opt-icon" alt="">
                        <span class="d-block mt-1 shareCount" style="color: #9300D3;">00</span>
                    </div>
                    <!-- share end -->
                </div>
            </div>
            <div class="qb-col">

                <div class="que-sec">

                    <!-- title question start -->
                    <div class="title-que">
                        <div class="tq-left">
                            <h4>({{ $faq->id }}) {{ $faq->question ?? '-' }}
                            </h4>
                        </div>
                        <div class="tq-right">
                            <a href="javascript:void(0)" class="btnFav" data-id="{{ $faq->id }}">
                                @if ($faq->faqFavourite()->where('user_id',auth()->user()->id)->first() == null)
                                <img src="{{ asset('images/title-rating.png') }}" alt="">
                                @else
                                <img src="{{ asset('images/favoris.png') }}" alt="">
                                @endif
                            </a>
                        </div>
                    </div>
                    <!-- title question end -->

                    <!-- sub title start -->
                    <div class="subtitle">
                        <p>
                            Question pose par
                            <span>{{ $faq->user->full_name ?? '-' }}</span>
                            le
                            <span>{{ $faq->created_at->diffForHumans() }}</span>
                            a
                            <span>{{ $faq->user->address->city ?? '-' }}</span>
                        </p>
                    </div>
                    <!-- sub title end -->

                    <!-- que-buttons start -->
                    <div class="que-buttons">
                        @foreach ($faq->category as $key => $category)
                        <a href="#"
                            class="foorbis-btn cat-btn cb-{{ $key + 1 }}">{{ $category->category->title ?? '-' }}</a>
                        @endforeach
                    </div>
                    <!-- que-buttons end -->

                    <!-- que-content start -->
                    <div class="que-content">
                        <div class="qc-top">
                            <div class="qct-header ">
                                <a href="javascript:void(0)" class="d-flex align-items-center">
                                    <img src="{{ asset('images/share.png') }}" class="img-fluid mr-1" alt="">
                                    <span style="color: #C2C2C2;">Partager</span>
                                </a>
                            </div>
                            <div class="qct-header ml-5">
                                <a href="javascript:void(0)" class="d-flex align-items-center">
                                    <img src="{{ asset('images/editor.png') }}" class="img-fluid mr-1" alt="">
                                    <span style="color: #C2C2C2;">Editer</span>
                                </a>
                            </div>
                        </div>
                        <hr>

                        <p>{{ $faq->description ?? '-' }}</p>
                    </div>
                    <!-- que-content end -->

                </div>
            </div>
        </div>
        <!-- question section end -->

        <!-- response section start -->
        <div class="qb-slide" style="width: -webkit-fill-available;">
            <div class="qb-img-opt"></div>
            <div class="qb-col">
                <div class="resp-sec mt-3">
                    <div class="resp-title">
                        <h5>{{ $faq->faqAnswer->count() ?? 0 }} Réponses</h5>
                        <a href="javascript:void(0)">
                            <img src="{{ asset('images/response-show.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <hr class="mt-1">
            </div>
        </div>
        <!-- response section end -->

        <!-- response content start -->

        <!-- rc-box start -->
        <div class="rc-box ansList{{ $faq->id }}">
            <!-- response 1 -->
            @foreach ($faq->faqAnswer as $ans)
            <div class="qb-slide">
                <div class="qb-img-opt">
                    <!-- image start -->
                    <div class="rc-img d-block">
                        <img src="{{ $ans->user->profile_path ?? '' }}" alt="">
                    </div>
                    <!-- image end -->
                </div>
                <div class="qb-col">
                    <p class="rc-title mb-2">
                        <span class="mr-2">{{ $ans->user->full_name ?? '-' }}</span>
                        depuis {{ $ans->created_at->diffForHumans() }}
                    </p>
                    <p class="rc-text">{{ $ans->answer ?? '-' }} </p>

                    <hr>
                </div>
            </div>
            @endforeach
        </div>
        <!-- rc-box end -->

        <!-- response content end -->

        {{-- </div> --}}
        <!-- question resp end -->


        <!-- vote response start -->
        {{-- <div class="vote-resp-box bg-white mt-5"> --}}
        <!-- title start -->
        <div class="vrb-title">
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
                        <img src="{{ auth()->user()->company->company_logo_path ?? '' }}" alt="">
                    </div>
                    <!-- image end -->
                </div>
                <div class="qb-col">
                    <form class="frmAnsFaq" data-id="{{ $faq->id }}" method="POST" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="faq_id" id="faq_id" value="{{ $faq->id }}" />
                        <textarea name="answer" rows="3" class="w-100 wr-textarea"></textarea>
                        <div>
                            <button type="submit" class="foorbis-btn d-inline-block mt-3 wr-btn">Poser
                                votre
                                réponse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- write response end -->

    </div>
    <!-- vote response end -->
</div>
@endforeach
