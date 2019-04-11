<?php
/**
 * Created by PhpStorm.
 * User: mizik
 * Date: 11.04.2019
 * Time: 12:06
 */

namespace Controllers;

use Models\Model_Record as Record;

class RecordPagination
{
    private static $limit;
    private static $number;

    static function getRecords($page,$sort,$ord){

        self::$limit = $_ENV['ST_PGN'];

        if(empty($page)){$page = 1;};
        if(empty($sort)){$sort = 'desc';};
        if(empty($ord)){$ord = 'id';};

        self::$number = ($page * self::$limit) - self::$limit;

        return array(
            'records' => self::find($sort,$ord),
            'pages' => self::amountPages()
        );
    }


    private static function find($sort,$ord)
    {
        return Record::findAll( 'records' ,'ORDER BY '.$ord.' '.$sort.' LIMIT '.self::$number.', '.self::$limit.'');
    }

    public static function pages()
    {
        return Record::count('records');
    }

    public static function amountPages()
    {
        return ceil(self::pages() / self::$limit);
    }
}