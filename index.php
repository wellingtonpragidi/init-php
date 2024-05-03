<?php ob_start();

include(__DIR__.'/config.php');

include view('index.php');


echo  URL::param(0);