<?php
/**
 * Created by PhpStorm.
 * User: mizik
 * Date: 11.04.2019
 * Time: 15:29
 */

namespace Controllers;

class DownloadController
{

    private $path = '../storage/';

    public function __construct($file,$ex)
    {

        $this->file_force_download($this->path.$file.'.'.$ex);

    }

    function file_force_download($file) {
        if (file_exists($file)) {


            if (ob_get_level()) {
                ob_end_clean();
            }


            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));

            if ($fd = fopen($file, 'rb')) {
                while (!feof($fd)) {
                    print fread($fd, 1024);
                }
                fclose($fd);
            }
            exit;
        }
    }

}