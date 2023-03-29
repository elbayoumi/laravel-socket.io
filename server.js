const express = require('express');
const app=express();
const server =require("http").createServer(app);
const io =require("socket.io")(server,{
    cors:{origin:"*"}
});

io.on('connection',(socket)=>{
console.log('connection');
socket.on('desconnect',(socket)=>{
    console.log('Disconnected');
})
});

server.listen(8000, ()=>{
console.log("Server listening on port 3000 is runing")
});
//
