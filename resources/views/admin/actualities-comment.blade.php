<h6 class="blog-comment-title">{{$blogComments->count()}} commentaires</h6>
<div class="singal-comment comment-new">
    <!-- comment-1 -->
    @foreach ($blogComments as $comment)
    <div>
        <div class="row">
            <div class="profile-comment">
                <img src="{{$comment->user->profile_path??null}}">
            </div>
            <div class="col-md-8">
                <div class="text-comment">
                    <p><span>{{$comment->user->full_name??'-'}}</span> depuis
                        {{$comment->created_at->diffForhumans()}}
                    </p>
                    <p>{{$comment->comment??'-'}} </p>
                </div>
            </div>
        </div>
        <div class="row response">
            <div class="col-md-12">
                <hr class="border-foorbis blog-border-foorbis">
            </div>
        </div>
    </div>
    @endforeach
</div>
