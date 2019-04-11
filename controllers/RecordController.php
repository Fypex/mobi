<?php

namespace Controllers;

use Models\Model_Record as Record;

class RecordController extends Controller
{
    private $urlCaptcha = 'https://www.google.com/recaptcha/api/siteverify';
    private $text;
    private $width = 320;
    private $height = 240;
    private $path;
    private $page;
    private $expansion;
    private $storage = '../storage/';

    /**
     * RecordController constructor.
     * @param $data
     * @param $file
     */
    public function __construct($data, $file)
    {
        $this->validateCaptcha($_ENV['CP_KEY'],$data['g-recaptcha-response']);

        $this->validateName($data['name']);
        $this->validateEmail($data['email']);
        $this->validatePage($data['page']);
        $this->validateText($data['text']);

        $this->validateFile($file);

        $id = Record::create(
            $data['name'],
            $data['email'],
            $this->page,
            $this->text,
            $this->path,
            str_replace('.','',$this->expansion)
        );

        if (is_int($id)){
            $this->json([
                'status' => 'success',
                'message' => 'Запись добавлена!',
            ]);
        }
    }


    public static function getRecords(){

        var_dump(Record::findAll('records'));

    }

    private function validateCaptcha($key,$response){

        $query = $this->urlCaptcha.'?secret='.$key.'&response='.$response.'&remoteip='.$_SERVER['REMOTE_ADDR'];
        $data =json_decode(file_get_contents($query),true);
        if (!true) {
            $this->json([
                'status' => 'error',
                'message' => 'Проверка капчи не пройдена'
            ]);
        }


    }

    /**
     * @param $name
     */
    private function validateName($name){

        if (empty($name)){
            $this->json([
                'status' => 'error',
                'message' => 'Введите ваше имя!',
            ]);
        }
        if (preg_match('/[^A-Za-z0-9]+/', $name)){
            $this->json([
                'status' => 'error',
                'message' => 'Имя должно состоять только из латинских букв и цифр',
            ]);
        }

    }
    private function validatePage($page){

        $this->page = htmlspecialchars($page);

    }
    /**
     * @param $email
     */
    private function validateEmail($email){
        if (empty($email)){
            $this->json([
                'status' => 'error',
                'message' => 'Введите почту!',
            ]);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->json([
                'status' => 'error',
                'message' => 'Неверный формат почты!',
            ]);
        }
    }

    /**
     * @param $text
     */
    private function validateText($text){
        if (empty($text)){
            $this->json([
                'status' => 'error',
                'message' => 'Введите текст сообщения!',
            ]);
        }

        $this->text = htmlspecialchars($text);
    }

    /**
     * @param $file
     */
    private function validateFile($file){

        switch ($file['file']['type']) {
            case 'text/plain':
                $this->validateTextFile($file,'.txt');
                break;
            case 'image/gif':
                $this->validateImgFile($file,'.gif');
                break;
            case 'image/jpeg':
                $this->validateImgFile($file,'.jpg');
                break;
            case 'image/png':
                $this->validateImgFile($file,'.png');
                break;
            case '':
                break;
            default:
                $this->json([
                    'status' => 'error',
                    'message' => 'Данный тип файла запрещен',
                ]);
                break;
        }

    }



    /**
     * @param $img
     * @param $expansion
     */
    private function validateImgFile($img, $expansion){
        list($width, $height) = getimagesize($img['file']['tmp_name']);

        if ($width > $this->width){

            $this->changeImageWidthAndHeight($img,$width,$height,$expansion);

        }else{

            $this->path = uniqid();
            $this->expansion = $expansion;
            $this->movefile($img,$expansion);

        }


    }


    /**
     * @param $file
     * @param $expansion
     */
    private function validateTextFile($file, $expansion){
        if ($file['file']['size'] > 100000){
            $this->json([
                'status' => 'error',
                'message' => 'Текстовый файл должен быть не более 100кб',
            ]);
        }

        $this->path = uniqid();
        $this->expansion = $expansion;
        $this->movefile($file,$expansion);
    }

    /**
     * @param $img
     * @param $width
     * @param $height
     * @param $expansion
     */
    private function changeImageWidthAndHeight($img, $width, $height, $expansion){

        $scalingFactor = $this->width / $width;
        $this->height = $height * $scalingFactor;

        $image_p = imagecreatetruecolor($this->width, $this->height);

        $image = imagecreatefromjpeg($img['file']['tmp_name']);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $this->width, $this->height, $width, $height);

        $this->path = uniqid();
        $this->expansion = $expansion;
        imagejpeg($image_p, $this->storage . $this->path . $expansion, 100);
    }


    /**
     * @param $img
     * @param $expansion
     */
    private function moveFile($img, $expansion){
        move_uploaded_file($img["file"]["tmp_name"], $this->storage . $this->path . $expansion);
    }
}