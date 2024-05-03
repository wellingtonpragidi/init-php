<?php
setlocale(LC_ALL, 'pt_BR.UTF-8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
date_default_timezone_set('America/Bahia');

# error_reporting(0);
# ini_set('display_errors', 0);

define( 'PATH', str_replace("\\", "/", __DIR__)."/" );

define( 'TITLE', 'Ton' );

function controller($extend = '') {
    return PATH.'controller/'.$extend;
}

function model($extend = '') {
    return PATH.'model/'.$extend;
}

function request($extend = '') {
    return PATH.'request/'.$extend;
}

function view($extend = '') {
    return PATH.'view/'.$extend;
}


include request('load.php');