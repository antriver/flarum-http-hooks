<?php

use Flarum\Event\PostWasPosted;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->listen(
        PostWasPosted::class,
        function (PostWasPosted $event) {
            print_r($event);
        }
    );
};
