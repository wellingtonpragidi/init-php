<?php 
class Stylesheets {
    static function compress($replace) {
        $replace = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $replace);
        $replace = str_replace(': ', ':', $replace);
        $replace = str_replace([' {', '{ '], '{', $replace);
        $replace = str_replace([' }', '} '], '}', $replace);
        $replace = str_replace([' (', '( '], '(', $replace);
        $replace = str_replace([' )', ') '], ')', $replace);
        $replace = str_replace(', .', ',.', $replace);
        $replace = str_replace(', #', ',#', $replace);
        $replace = str_replace(', ', ',', $replace);
        $replace = str_replace('; ', ';', $replace);
        $replace = str_replace(';}', '}', $replace);
        $replace = str_replace(["\r\n", "\r", "\n", "\t", "  ", "   ", "    "], "", $replace);
    }

    static function css() {
        ob_start(['self', 'compress']);

        if( file_exists(PATH.'assets/fonts/fonts.css') ) {
            include_once(PATH.'assets/fonts/fonts.css');
        }

        $iterator = new RecursiveIteratorIterator( 
            new RecursiveDirectoryIterator( 
                PATH.'assets/css/' 
            ),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach($iterator as $file) { 
            if($file->isDir()) continue;
            if($file->getExtension() == 'css') {
                include_once( $file->getRealPath() );
            }
        }
        
        ob_end_flush();
    }
}
