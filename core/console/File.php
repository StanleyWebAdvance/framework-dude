<?php

namespace core\console;

use helpers\Snippet;

class File implements \FileInterface
{
    const PATH_CONTROLLER = 'resources/snippet/controller.txt';
    const PATH_MODEL = 'resources/snippet/model.txt';
    const PATH_REQUEST = 'resources/snippet/request.txt';
    const PATH_MIDDLEWARE = 'resources/snippet/middleware.txt';

    /** создаем файл и запускаем нужный метод
     *
     * @param $entity
     * @param $path
     * @param $name
     */
    public static function create($entity, $path, $name)
    {
        $file =  $path . '/' . $name . '.php';

        if (file_exists($file)) {

            echo 'file ' . $file . ' already exist, bro! Check out.';
            exit();
        }

        $newFile = fopen($file, 'w');
        mb_strtolower($entity);
        fwrite($newFile, self::$entity($path, $name));
        fclose($newFile);
    }

    /** генерируем controller
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function controller($path, $name)
    {
        return Snippet::render(self::PATH_CONTROLLER,  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name
        ));
    }

    /** енерируем model
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function model($path, $name)
    {
        return Snippet::render(self::PATH_MODEL,  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name,
            'table' => mb_strtolower(str_replace('Model', '', $name))
        ));
    }

    /** генерируем middleware
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function middleware($path, $name)
    {
        return Snippet::render(self::PATH_MIDDLEWARE,  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name
        ));
    }

    /** генерируем request
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function request($path, $name)
    {
        return Snippet::render(self::PATH_REQUEST,  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name
        ));
    }
}