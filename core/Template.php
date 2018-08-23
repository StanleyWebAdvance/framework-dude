<?php

namespace core;

use Philo\Blade\Blade;

class Template
{
    const CACHE_PATH = __DIR__ . '/../storage/cache/view';
    const VIEW_PATH = __DIR__ . '/../resources/view/';

    /** подключаем шаблон и передаем параметры
     *
     * @param $uri
     * @param array $params
     * @return bool
     */
    public function Render($uri, array $params = array())
    {
        $blade = new Blade(self::VIEW_PATH, self::CACHE_PATH);

        echo $blade->view()->make($uri, $params)->render();

        return true;
    }
}