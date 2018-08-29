<?php 
namespace app\controllers;

use app\requests\FileRequest;
use core\template\Controller;
use helpers\Debug;
use Intervention\Image\ImageManager;

class FileController extends Controller
{
    public function upload()
    {
        $request = new FileRequest();

        $message = $request->checkFiles();

        if ($message['error']) {

            return (new PageController())->index($message['errors']);
        }

        Debug::dump($request->take('tmp_name')->files('image'));

        Debug::dump($request->files('image'));

        $image = new ImageManager();

        $image->make($request->take('tmp_name')->files('image'))->save('storage/uploads/111.jpg');



    }
}