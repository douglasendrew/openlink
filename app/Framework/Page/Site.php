<?php

    namespace SimpleWork\Framework\Page;

    class Site
    {

        public static $nome_site;
        public static $page_name;
        public static $url_site;

        public function __construct()
        {
            self::load();
        }

        public static function load() : void
        {
            require __DIR__ . "/../../Config/page.php";
        }

        public static function site_name($site) : string
        {
            self::$nome_site = $site;
            return self::$nome_site;
        }

        public static function getSiteName() : string
        {
            self::load();
            return self::$nome_site;
        }

        public static function page_name($page_name) : string
        {
            self::$page_name = $page_name;
            return self::$page_name;
        }

        public static function getPageName() : string
        {
            self::load();
            return self::$page_name;
        }

        public static function genTitlePage() : string
        {
            self::load();
            if (empty(self::$page_name)) {
                return self::$nome_site;
            } else {
                return self::getSiteName() . " - " . self::getPageName();
            }
        }

        public static function getSiteLink() : string
        {
            $http = (!empty($_SERVER['HTTPS'])) ? "https://":"http://"; 
            $dominio = $_SERVER["HTTP_HOST"];
            $diretorio = $_SERVER["REQUEST_URI"];

            if(strtolower($dominio) == "localhost")
            {
                $diretorio = explode("/", $diretorio);
                return $http.$dominio."/".$diretorio[1]."";
            }else {
                return $http.$dominio."";
            }
        }

        public static function getHTTPType() : string
        {
            $http = (!empty($_SERVER['HTTPS'])) ? "https://":"http://"; 
             
            return $http;
        }

        public static function redirect( string $caminho ) : void
        {
            echo "<script>window.location.href='". self::getSiteUrl() . $caminho ."'</script>";
            exit;
        }

        public static function require_login( $resp ) : void
        {   
            session_start();
            
            if( $resp == true )
            {
                if(!isset($_SESSION['logged']) and $_SESSION['logged'] != true)
                {
                    self::redirect("login");
                    exit;
                }
            }
        } 

        public static function site_get_url( $url ) : string
        {   
            $url_replaced = str_replace("index.php", "", $url);
            return self::getHTTPType() . $_SERVER["HTTP_HOST"] . $url_replaced;
        } 


        public static function setSiteUrl( $url ) : void
        {   

            self::$url_site = $url;
            
        } 
        
        public static function getSiteUrl() : string
        {   
            return self::$url_site;
        } 

    }
