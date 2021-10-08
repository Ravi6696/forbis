<div>
    <div class="messages">
        <div class="col-12">
            <p class="messages-top-heading">mEs messages</p>
            <hr>
        </div>
        <div class="all-msg-fix scrollbar">
            @foreach ($users as $user)
            <div class=" singal-message unread-msg view-msg" data-id="{{$user->coversation->id ?? null}}"
                data-user_id="{{$user->id}}">
                <div class="innner-singal">
                    <div class="msg-profile-img online">
                        <img class="online-img" src="{{$user->profile_path ?? null}}">
                    </div>
                    <div class="meg-info">
                        <div class="row msg-description">
                            <div class="messager-name">{{$user->full_name ?? '-'}}</p>
                            </div>
                            <div class="message-time">
                                {{isset($user->coversation->last_message) ? $user->coversation->last_message->created_at->diffForHumans():'-'}}
                                </p>
                            </div>
                            @isset($user->coversation->id)
                            <div class="close-message" data-id="{{$user->coversation->id ?? null}}">
                                <a class="message-close" href="#"><img src="images/close.png"></a>
                            </div>
                            @endisset
                            <div class="col-12">
                                <p class="messages-topic">
                                    {{isset($user->coversation->last_message) ? $user->coversation->last_message->message:null}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click','.view-msg',function(params) {
                var conversation_id = $(this).data('id');
                var user_id = $(this).data('user_id');
                $.ajax({
                    url: "{{ route('delete-conversation') }}",
                    type: 'get',
                    data: {
                        conversation_id:conversation_id,
                        user_id:user_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.key == 1) {
                            $('.show-chat').html(response.data);
                            $(".show-msgs").animate({ scrollTop: $('.show-msgs').prop("scrollHeight")}, 1000);
                        }
                    },
                })
            });

            $(document).on('click','.close-message',function(params) {
                var conversation_id = $(this).data('id');
                $.ajax({
                        url: "{{ route('delete-conversation') }}",
                        type: 'POST',
                        data: {
                            'conversation_id': conversation_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response.message);
                            if (response.key == 1) {
                                toastr.success(response.message);
                                div.remove();
                            } else {
                                $.each(response.message, function(i, val) {
                                    $('.error-' + i).text(val);
                                });
                            }
                        },
                    })
            });
        });
    </script>
    @endpush
</div>
