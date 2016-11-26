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
        <form method="POST" action="sendMessages" id="formchat">
            <div class="input-group" id="chatform">
                <input type="text" id="chatinput" name="body" class="form-control">
                @if(Auth::guest())
                    <input type="hidden" name="username" value="" required>
                @else
                    <input type="hidden" name="username" value="{{ Auth::user()->name }}" required>
                @endif
                <span class="input-group-btn">
                <button class="btn btn-default" type="button">Send</button>
            </span>
            </div>
        </form>
    </div>
</footer>