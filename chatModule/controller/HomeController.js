

exports.home =   function (req, res) {
	res.writeHead(200, {
        'Content-Type': 'text/html'
    });
    res.write(`<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
socket conected
<script src="/socket.io/socket.io.js"></script>
<script type="text/javascript">
	const socket = io()
	socket.emit('login',{data:2});
	socket.emit('login',{data:3});
	// socket.emit('send',{receiver_id:1,msg:'ravi',sender_id:3,conversation_id:''});
	// socket.on('recev_msg',details => {
 //    console.log(details)
 //  	})
	// socket.emit('disconect',{user_id:3});
	// socket.emit('removeGroup',{group_id:1});

</script>
</body>
</html>`);
    res.end();
};
