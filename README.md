- Requirements
    1. redis server package for laravel
        ``` brew install redis ``` or ``` composer require predis/predis ```
    2. Install Laravel Echo Server
        ``` npm install -g laravel-echo-server ```
    3. Install Socket and Laravel Echo
        ``` npm i socket.io-client ``` 
        ``` npm i laravel-echo ```

- Redis Setup
    1. ``` BROADCAST_DRIVER=redis ``` in ".env" file
    2. ``` 'default' => env('BROADCAST_DRIVER', 'redis') ``` in "broadcasting.php" file
    3. ``` 'client' => env('REDIS_CLIENT', 'predis') ``` in "database.php" file
    4. ``` Broadcast::routes(); ``` in "web.php" file

- Starting Servers at project run
    1. ``` laravel-echo-server init ```
    2. ``` laravel-echo-server start ```

- Load app.js and app.css 
    ``` npm run watch ```

- Add this to bootstrap.js
    import Echo from 'laravel-echo'
    window.io = require('socket.io-client')

    window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001' // this is laravel-echo-server host
    })


- Monitoring Log
    1. Redis: ``` redis-cli monitor ```

- For listning
 Echo.private('chat.' + 1)
  .listen('ChatEvent', e => {
      console.log(e)
  })
