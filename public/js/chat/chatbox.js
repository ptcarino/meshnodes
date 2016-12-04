// Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.http.options.crossOrigin = true;

Vue.component('chat', {
    template: '#chat-template',

    data: function() {
        return {
            chatlist: []
        };
    },

    created: function () {
        this.getData();
    },

    /*ready: function () {
        // this.getData();
        setInterval(this.ajax, 3000);
    },*/

    methods: {
        getData: function () {
            this.$http.get('http://emesh.ddns.net/chatdata/', function(chats) {
                this.chatlist = chats;
                console.log(chats);
            }.bind(this));
            setTimeout(this.getData, 5000);
        },

        /*ajax: function () {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200) {
                    document.getElementById('chatbox').innerHTML = req.responseText;
                }
            }
            req.open('GET','chatdata',true);
            req.send();
        }*/
    }
});


new Vue({
    el: '#chatbox',

    data: {
        chat: {
            body: '',
            username: '',
        }
    },
    
    /*methods: {
        sendChat: function (e) {
            e.preventDefault();
            console.log(chat);
            var chat = this.chat;
            this.$http.get('sendMessages', chat);
        },
    }*/
});