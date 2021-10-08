<div class="foorbis-announces auf-announces">
    <label>
        {{$announces->count()}} Announces
    </label>
    <br>
    <hr>
    <div class="cards  annouce-cards scrollbar">
        <div class="row">
            @foreach ($announces as $announce)
            <div class="col-4 updateAdDetail" data-id="{{ $announce->id }}">
                <div class="card">
                    <div class="upr">
                        <div class="upr-img">
                            <img src="{{ $announce->attachment_path ?? null }}" alt="">
                        </div>
                        <div class="upr-icon">
                            <img src="{{ $announce->company->company_logo_path ?? null }}" alt="">
                        </div>
                    </div>
                    <div class="lower">
                        <h4>
                            {{ $announce->name ?? null }}
                        </h4>
                        <h5>
                            {{ $announce->category->title ?? null }}
                        </h5>
                        <h6 class="m-0">
                            {{ \Carbon\Carbon::parse($announce->start_date)->format('d-m-Y') ?? null }}
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>