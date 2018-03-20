<?php

namespace Antriver\FlarumHttpHooks\Listener;

use Antriver\FlarumHttpHooks\UrlRepository;
use Flarum\Event\PostWasPosted;
use Illuminate\Contracts\Events\Dispatcher;

class NewPostListener
{
    /**
     * @var UrlRepository
     */
    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(PostWasPosted::class, [$this, 'postWasPosted']);
    }

    /**
     * @param PostWasPosted $event
     */
    public function postWasPosted(PostWasPosted $event)
    {
        $urls = $this->urlRepository->getUrlsForEvent('PostWasPosted');
        if (empty($urls)) {
            return;
        }

        $post = $event->post;
        $actor = $event->actor;

        $payload = [
            'actor' => $actor->toArray(),
            'post' => $post->toArray(),
        ];

        $guzzleClient = new \GuzzleHttp\Client();

        foreach ($urls as $url) {
            $guzzleClient->request(
                'POST',
                $url,
                [
                    'form_params' => $payload,
                ]
            );
        }
    }
}
