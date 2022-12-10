<?php

    namespace SimpleWork\Core;

    use SimpleWork\Framework\Routes\Rotas;
    use SimpleWork\Framework\Page\Site;
    use SimpleWork\Framework\Database\Db;

    class Run
    {

        private static $tipo_requisicao;
        private static $rota;

        public static function init( $site_url = "" )
        {

            Site::setSiteUrl($site_url);

            if(!Db::db_connect())
            {
                echo '<!DOCTYPE html> <html lang="pt-BR"><head><meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Banco de Dados Error</title> </head> <style>@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"); *{font-family: "Roboto", sans-serif;}</style> <body> <div style="text-align: center;"> <p style="font-size: 25px;">OpenLink</p>Erro: Não foi possivel conectar ao banco de dados, verifique os dados fornecidos e tente novamente. </div></body> </html>';
                exit;
            }else {

                session_start();
                
                self::$tipo_requisicao = $_SERVER['REQUEST_METHOD'];
    
                if (isset($_GET['pag'])) {
                    $url = $_GET['pag'];
                }
    
                if (!empty($url)) {
                    $url = explode("/", $url);
    
                    $controller = $url[0] . "Controller";
                    array_shift($url);
    
                    if (isset($url[0]) && !empty($url[0])) {
                        $metodo = $url[0];
                        array_shift($url);
                    } else {
                        $metodo = "index";
                    }

                    if (count($url) > 0) {
                        $parametros = $url;
                    }
                } else {
                    $controller = "homeController";
                    $metodo = "index";
                }
    
                // Configurações das rotas
                if (isset($controller)) {
    
                    $controller = str_replace("Controller", "", $controller);
                    self::$rota = $controller;
    
                    if (isset($metodo) and !empty($metodo)) {
    
                        self::$rota .= "/" . $metodo;
    
                        if (isset($parametros) and !empty($parametros) and $metodo != "index") {
                            self::$rota .= "/";
                        }
                    }

                }
    
                $request_method = Rotas::get(self::$rota);

                if ($request_method != self::$tipo_requisicao) {
    
                    if ($request_method == "PUT") {
    
                        if (!isset($parametros) or empty($parametros)) {
                            $controller = "errorController";
                            $metodo = "errorRotas";
                        }

                    } else if ($request_method == "POST") {
    
                        if(self::$tipo_requisicao != "POST")
                        {
                            $controller = "error";
                            $metodo = "errorPost";
                        }

                    } else {
    
                        $controller = "error";
                        $metodo = "error404";

                    }

                }
    
                $controller = $controller . "Controller";

                $dir = __DIR__ . "/../Framework/Controllers/" . $controller . ".php";
    
                if (file_exists($dir)) {
    
                    require $dir;
    
                    $class = "\SimpleWork\Framework\Controllers\ " . $controller;
                    $class = str_replace(" ", "", $class);

    
                    $instanc = new $class;
                        
                    if (method_exists($instanc, $metodo)) {
                        
                        if(!isset($parametros))
                        {
                            $parametros = "";
                        }
                        
                        call_user_func_array(array($instanc, $metodo), array($parametros));

                    } else {
    
                        $controller = "errorController";
                        $metodo = "error404";
    
                        $class = "\SimpleWork\Framework\Controllers\ " . $controller;
                        $class = str_replace(" ", "", $class);
    
                        $instanc = new $class;
    
                       
                        call_user_func_array(array($instanc, $metodo), array($parametros));
    
                        exit;
                    }
                } else {
    
                    $controller = "errorController";
                    $metodo = "error404";
    
                    $class = "\SimpleWork\Framework\Controllers\ " . $controller;
                    $class = str_replace(" ", "", $class);
    
                    $instanc = new $class;
    
                    call_user_func_array(array($instanc, $metodo), array($parametros));
    
                    exit;
                }
            }
        }

        public static function loadIncludes()
        {
            require __DIR__ . "/../Config/Includes.php";
        }

        public static function include($arq_name, $arq_type)
        {
            $dir = Site::getSiteUrl() . "includes/" . strtolower($arq_type) . "/" . $arq_name;
            
            if (strtolower($arq_type) == "js") {
                echo '<script src="' . $dir . '"></script>';
            } else if (strtolower($arq_type) == "css") {
                echo '<link rel="stylesheet" href="' . $dir . '">';
            } else {
                require $dir;
            }

        }

        public static function url_include($url, $type_arquivo)
        {

            if (strtolower($type_arquivo) == "js") {
                echo '<script src="' . $url . '"></script>';
            } else if (strtolower($type_arquivo) == "css") {
                echo '<link rel="stylesheet" href="' . $url . '">';
            }

        }

        public static function dir_include($arq_dir, $arq_type)
        {
            require __DIR__ . "/../../includes/" . strtolower($arq_type) . "/" . $arq_dir;
        }

        public static function get_url()
        {

            if (!empty($_SERVER['HTTPS'])) {
                $http = 'https://';
            }else{
                $http = 'http://';
            }

            return "$http$_SERVER[HTTP_HOST]/SimplesWork/";

        }

    }
