<?php

namespace Controllers;

use Flight;

class IndexController extends RecordPagination
{

    public function index(){
        $data = RecordPagination::getRecords($_GET['page'],$_GET['sort'],$_GET['ord']);

        Flight::render('index', array(
            'records' => $data['records'],
            'pages' => $data['pages']
        ));

    }

}