<?php

    /**
     * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     *             SIMPLEWORK 
     * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     * 
     *  @author github.com/douglasendrew
     *  @version 1.1
     * 
     * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     * 
    */

    if(!is_dir("vendor"))
    {
        echo "Por favor, execute o comando <code>composer dumpautoload -o</code> no console";
        exit;
    }

    error_reporting(0);

    require "vendor/autoload.php";

    use SimpleWork\Core\Run;
    use SimpleWork\Framework\Page\Site;

    $GetSubDirectorys = Site::site_get_url($_SERVER['PHP_SELF']);
    
    Run::init(
        $GetSubDirectorys
    );    
    
    exit;

?>