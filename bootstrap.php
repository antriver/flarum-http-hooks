<?php

use Antriver\FlarumHttpHooks\Listener\NewPostListener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(NewPostListener::class);
};
