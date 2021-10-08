const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const path = require('path');

const Conevrsations = require('./models/Conevrsations.js');
const ConevrsationsMessage = require('./models/ConevrsationsMessage.js');
const Users = require('./models/Users.js');

//For orm system 
const { Model } = require('objection');
global.knex = require('knex')(require('./db.js'));

Model.knex(knex);

//chat run nothis server 

const port = 2306;

// configure middleware
app.set('port', process.env.port || port); // set express to use this port

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json()); // parse form data client

// Make the files in the public folder available to the world
app.use(express.static(__dirname + '/public'));

// Require routes
require('./routes/route.js')(app);

//conction of app
const http = require('http').Server(app);
const io = require('socket.io')(http);

// set the app to listen on the port
http.listen(port, () => 
{
    console.log(`Server running on port: ${port}`);
});
//call controller


//socket conection and working here 
let users_list = {};

io.on('connection', (socket) => {
  console.log('done')

    //ADD AND CHECK ROOME IN TO SOCKET 
    //in case server is stoped than call this function and add group in to room
    
    
  socket.on('login',data=>{
    users_list[data.data] = {id: socket.id ,user_id: data.data,status: 'online' };
  })

  // Send msg to PToP user 
  socket.on('send',msg_details => {
    let socket_details = users_list[msg_details.receiver_id];
    if(socket_details){
      socket.broadcast.to(socket_details.id).emit('recev_msg',{msg_details:msg_details.msg,check:msg_details.check,receiver_id:msg_details.receiver_id})
    }
  })
  
  socket.on('disconect',details => {
    //place here rome id who user login
   
  })

});

