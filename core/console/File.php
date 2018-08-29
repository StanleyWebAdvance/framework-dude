<?php

namespace core\console;

class File implements \FileInterface
{
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

            echo 'file ' . $file . ' already exist!';
            exit();
        }

        $newFile = fopen($file, 'w');

        $nameMethod = 'gen' . $entity;

        fwrite($newFile, self::$nameMethod($path, $name));

        fclose($newFile);
    }

    /** генерируем controller
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function genController($path, $name)
    {
        return self::render('resources/snippet/controller.txt',  array(
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
    private static function genModel($path, $name)
    {
        return self::render('resources/snippet/model.txt',  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name,
            'table' => str_replace('Model', '', $name)
        ));
    }

    /** генерируем middleware
     *
     * @param $path
     * @param $name
     * @return string
     */
    private static function genMiddleware($path, $name)
    {
        return self::render('resources/snippet/middleware.txt',  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name
        ));
    }

    private static function genRequest($path, $name)
    {
        return self::render('resources/snippet/request.txt',  array(
            'php' => '<?php ',
            'path' => str_replace('/', '\\', $path),
            'name' => $name
        ));
    }

    /** получаем нужный шаблон
     *  и заполняем его данными
     *
     * @param $filePath
     * @param array $params
     * @return string
     */
    private static function render($filePath, array $params = array())
    {
        ob_start();
        extract($params);
        include_once $filePath;
        return ob_get_clean();
    }

}