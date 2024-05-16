<?php
class URL {

    private $slug = NULL;

    static function root($extend = '') {
        $root = __DIR__.'/';
        $root = str_replace("\\", "/", $root);
        $root = str_replace($_SERVER["DOCUMENT_ROOT"], $_SERVER["SERVER_NAME"], $root);
        return self::protocol().$root.$extend;
    }
    
    static function current() {
        return self::protocol().$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    static function iG($action) {
        return isset($_GET[$action]) ? $_GET[$action] : '';
    }

    private static function protocol() {
        return isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    }

    /**
     * 
     * URL amigavel 
     * */
    static function param($param) {
        return (new URL)->slugify($param);
    }

    public function slugify($param) {
        if($this->slug == NULL)
            $this->listurl();

        if(isset($this->slug[$param])) 
            return $this->slug[$param];

        return NULL;
    }

    private function listurl() {

        $delete_index = substr($_SERVER["SCRIPT_FILENAME"], strlen( $_SERVER["DOCUMENT_ROOT"] ), - 9);

        $request = substr($_SERVER["REQUEST_URI"], strlen( $delete_index ));

        $uri_tmp = explode("?", $request);
        $request = $uri_tmp[0];

        $after_bar = explode("/", $request);
        $regress = array();

        for($i = 0; $i <= count($after_bar); $i ++) {
            if(isset($after_bar[$i]) AND $after_bar[$i] != "") {
                array_push($regress, $after_bar[$i]);
            }
        }
        $this->slug = $regress;
    }
}
