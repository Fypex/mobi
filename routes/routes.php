<?php 



Flight::route('/', array('Controllers\IndexController','index'));


Flight::route('POST /record/add', function (){
    new \Controllers\RecordController($_POST,$_FILES);
});

Flight::route('/@link/@ex', function ($link,$ex){
    new \Controllers\DownloadController($link,$ex);
});