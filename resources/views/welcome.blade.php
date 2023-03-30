<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App Socket.io</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
   <style>
   ul{
    margin: 0;
    padding: 0;
    list-style: none;

   }
   ul li {
    padding: 1rem;
    background: ghostwhite;
    margin-bottom: 1.5rem;
   }
ul li:nth-child(2n-2){
    background-color: #c3c5c5;
}
.chat-input{
    border: 1px solid lightgray;
    border-top-right-radius:1rem ;
    border-top-left-radius:1rem ;
    padding: 8px 10px;
}
   </style>
    </head>
 <body>
<div class='container' >
    <div class="row m-5">
    <div>

       <div class="type">

       </div>
       <div class="chat-section">
            <div class="chat-box">
                <div class="chat-input " id="chatInput" contenteditable="">

                </div>
            </div>
       </div>
       <div class="chat-conent border border-primary p-4 mt-4">
            <ul>
<li class="li d-none"></li>
            </ul>
       </div>
    </div>
    </div>
</div>

 <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

 <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script>
    $(function () {
        let ip_address = '127.0.0.1';
        let socket_port='3000';
        let socket=io(ip_address + ':' + socket_port);
        // socket.on('connection');
        let chatInput=$('#chatInput');

    chatInput.keypress(
            function(e){
                let message=$(this).html();
                console.log(message);
                if(e.which === 13 && !e.shiftKey){
                    socket.emit('sendChatToServer',message)
                    chatInput.html("")
                    return false;
                }

            }
        )
        socket.on('sendChatToClient',(messege)=>{
        $('.chat-conent ul .li').after(`<li>${messege}</li>`);
        //   $("#chatInput").on("input",(event)=>{
        //     $('.type').append('event')
        //   })
        });
        chatInput.on("input",(event)=>{


                socket.emit('sendChatToServerTyping','typing ...')



        });
                 socket.on('sendChatToClientTyping',(messege)=>{
$('.type').text(messege);
setTimeout(()=>{
                $('.type').text('')
            },800)
        })

    });
</script>
</body>
</html>
