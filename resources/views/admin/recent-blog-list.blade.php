@foreach ($blogs as $item)
<div class="card-text mt-4">
    <h5 class="mb-4"> - {{$item->title}}</h5>
    <p class="mb-1">Par <span class="text-pink">{{$item->user->full_name??'-'}} </span>le <span
            class="text-primary">{{$item->created_at->diffForhumans()}}</span></p>
    <p class="mb-0">{{$item->sub_title}}</p>
</div>
<div class="line-hr"></div>
@endforeach
