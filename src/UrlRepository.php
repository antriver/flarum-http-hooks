<?php

namespace Antriver\FlarumHttpHooks;

use Flarum\Settings\SettingsRepositoryInterface;

class UrlRepository
{
    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    private $urls = null;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param string $eventName
     *
     * @return string[]
     */
    public function getUrlsForEvent($eventName)
    {
        $this->loadUrls();

        return !empty($this->urls[$eventName]) ? $this->urls[$eventName] : [];
    }

    private function loadUrls()
    {
        if ($this->urls !== null) {
            return $this->urls;
        }

        $urls = $this->settings->get('flarum-http-hooks.urls');
        if (empty($urls)) {
            $this->urls = [];
        } else {
            $urls = json_decode($urls, true);
            if (empty($urls)) {
                $this->urls = [];
            } else {
                $this->urls = $urls;
            }
        }
    }
}
