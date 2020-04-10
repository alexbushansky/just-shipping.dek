

import Echo from "laravel-echo"
require('./bootstrap');
window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'dd858b857614f37de5cb',
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
});
