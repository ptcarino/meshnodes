<div class="panel panel-default chat-panel-heading">
    <div class="panel-heading" style="background-color: #ffffff;">
        <b>Chat</b>
    </div>
</div>
<footer class="footer boxscroll">
    <div class="container-fluid">
        <div class="row">
            <div class="panel-body chat-container" id="chatbox">
                <chat></chat>
            </div>
        </div>
    </div>
</footer>
<footer class="footer-div">
    <div class="footer-panel-footer">
        <form method="POST" action="http://192.168.11.4/chatdata" id="formchat">
            <div class="input-group" id="chatform">
                <input type="text" id="chatinput" name="message" class="form-control">
                @if(Auth::guest())
                    <input type="hidden" name="username" value="" required>
                @else
                    <input type="hidden" name="username" value="{{ Auth::user()->name }}" required>
                    <input type="hidden" name="mac" value="{{ Auth::user()->mac }}" required>
                @endif
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Send</button>
            </span>
            </div>
        </form>
    </div>
</footer>

<template id="chat-template">
    <div class="container-fluid">
        <div class="row message-bubble" v-for="chat in chatlist">
            <p class="text-muted"><strong>@{{ chat.username }}</strong> &nbsp;&nbsp;@{{ chat.created_at }}</p>
            <span>@{{ chat.body }}</span>
        </div>
    </div>
    {{--<div class="header" v-for="chat in chatlist">
        <p class="text-muted"><strong>@{{ chat.username }}</strong> &nbsp;&nbsp;@{{ chat.created_at }}</p>
        <span>@{{ chat.body }}</span>
    </div><br>--}}
</template>
