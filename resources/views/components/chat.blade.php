<div>
    <div class="full-text-msg">
        <div class="fix-height-text-msg scrollbar show-msgs">
            <input type="hidden" name="conversation_id" id="conversation_id" value="{{$conversation->id ?? null}}">
            <input type="hidden" name="user_id" id="user_id" value="{{$user_id ?? null}}">
            @foreach ($chats as $chat)
            @if (auth()->user()->id == $chat->user_id)
            <div class="row text-msg  receive-message">
                <div class="perpal-text-msg">
                    <p class="text-inmsg">{{$chat->message??'-'}} </p>
                </div>
                <div class="text-msg-profile">
                    <img src="{{$chat->user->profile_path??null}}">
                </div>
            </div>
            @else
            <div class="row text-msg">
                <div class="text-msg-profile">
                    <img src="{{$chat->user->profile_path??null}}">
                </div>
                <div class="perpal-text-msg">
                    <p class="text-inmsg">{{$chat->message??'-'}}</p>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div class="sms-text-input">
            <div class="col-12 p-0">
                <hr style="width: 97%;margin-left: 0px;margin-bottom: 0px;">
            </div>
            <div class="row" style="padding: 0px 15px">
                <div class="send-message-input">
                    <input type="text" name="message" id="message" placeholder="Message ...">
                </div>
                <div class="___class_+?207___">
                    <button class="send-message-btn" id="send-message-btn"><img src="images/send-message-icon.png"
                            class="mr-2">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
