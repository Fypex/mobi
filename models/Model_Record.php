<?php

namespace Models;

use \RedBeanPHP\R as R;

class Model_Record extends R
{
    public static function create($name, $email, $page, $text, $path, $expansion){

        $record = Model_Record::dispense('records');
        $record->name = $name;
        $record->email = $email;
        $record->homepage = $page;
        $record->text = $text;
        $record->path = $path;
        $record->expansion = $expansion;
        $record->date = time();
        $record->ip = $_SERVER['REMOTE_ADDR'];
        $record->agent = $_SERVER['HTTP_USER_AGENT'];

        return Model_Record::store($record);

    }

}