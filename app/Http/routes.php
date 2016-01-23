<?php

use App\Events\UserSignedUp;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    /*
     * Goals for the demonstration of combining Laravel, Redis, Node & Socket.io
     */

    // 1. Publish Event with Redis

    /*
     * 1.2 Publish the event to the Redis 'test-channel' by JSON encoding the data into Redis
     * 1.2.1 - In laravel, events can be much more extensible; there are several options
     *    Dependency Injection for the Event Dispatcher
     *    Event Fire
     *    Global Event Function
     */
    //Redis::publish('test-channel', json_encode($data)); //1.2
    event(new UserSignedUp('Whinnie the Pooh')); //1.2.1

    // 2. Node.js + Redis subscribes to even
    /*
     * Node will run from the project root folder's 'socket.js' file to
     *   Read from Redis
     *   Broadcast the event on Socket.io
     *
     * See the socket.js file in the project root
     * This file must be triggered with `node socket.js` in order to setup the node server
     */

    // 3. Use Socket.io to emit to all clients
    /*
     * Added the emit event from Socket.io on the server side to the socket.js file
     *
     * The next step is to add in the client side socket.io
     */
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
