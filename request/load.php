<?php

spl_autoload_register( function($class) {
    if( file_exists(view($class.'.php')) ) {
        include_once view($class.'.php');
    }
});

$request = new RecursiveIteratorIterator( 
    new RecursiveDirectoryIterator( request() ), 
    RecursiveIteratorIterator::SELF_FIRST
);
foreach($request as $file) { 
    if($file->isDir()) continue;
    if($file->getExtension() == 'php') {
        include_once( $file->getRealPath() );
    } 
}