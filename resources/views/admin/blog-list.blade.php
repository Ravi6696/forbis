<div class="row">
    @foreach ($blogs as $item)
    <div class="col-lg-6 col-xl-4 card-mb-5">
        <a href="{{route('actuality-detail',$item->id)}}">
            <div class="card bg-transparent border-0">
                <div class="card-img-top"><img src="{{$item->attachment_path}}" alt="Card image cap">
                </div>
                <div class="card-body bg-white border-bottom-radius">
                    <div class="card-text">
                        <h5>{{$item->title}}</h5>
                        <p>Par <span class="text-pink">{{$item->user->full_name ?? '-'}} </span>le <span
                                class="text-primary">{{$item->created_at->diffForhumans()}}</span></p>
                        <p class="mb-0">{{$item->sub_title}}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
