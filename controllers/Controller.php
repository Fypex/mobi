<?php

namespace Controllers;

class Controller
{
    public function json($data){
        echo json_encode($data,true);
        exit();
    }
}