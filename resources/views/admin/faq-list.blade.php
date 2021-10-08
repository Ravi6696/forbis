@if (count($categories))
    <div class="faq-main-container scrollbar">
        @foreach ($categories as $item)
            @if (sizeof($item->faqCategory))
                <div class="foorbis-question-head foorbis-announces">
                    <h5 class="text-primary">{{ $item->title ?? '-' }}</h5>
                </div>
                <div>
                    @foreach ($item->faqCategory as $faq)
                        @if ($faq->faqs)
                            <div class="accordion foorbis-boxshadow p-0">
                                <input type="checkbox" class="acc-input" name="radio-a"
                                    id="check{{ $faq->id }}">
                                <label class="accordion-label align-items-center"
                                    for="check{{ $faq->id }}">{{ $faq->faqs->question ?? '-' }}
                                </label>
                                <div class="accordion-content">
                                    <hr class="mt-0">
                                    <p>{{ $faq->faqs->description ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </hr>
                </div>
            @endif
        @endforeach
    </div>
@else
    <div class="container">
        <p>No Faq details found..</p>
    </div>
@endif
