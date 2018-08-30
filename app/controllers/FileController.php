<?php 
namespace app\controllers;

use app\requests\FileRequest;
use core\config\Config;
use core\image\Image;
use core\template\Controller;
use helpers\String;

class FileController extends Controller
{
    public function upload()
    {
        $request = new FileRequest();

        $message = $request->checkFiles();

        if ($message['error']) {

            return (new PageController())->index($message['errors']);
        }



        $image = new Image();

        $name = $request->take('name')->files('image');

        $path = Config::storage('image') . String::translit($name);

        $tmp_name = $request->take('tmp_name')->files('image');

        $image->make($tmp_name)->save($path);



    }
}