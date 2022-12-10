<?php

    namespace SimpleWork\Framework\Routes;

    class Rotas 
    {

        public static $rotas = array();
        public static $req_type;

        public function __construct()
        {
            return self::loaderAll();
        }

        public static function loaderAll()
        {
            require __DIR__ . "/../../Config/rotas.php";
        }

        public static function set($route_name, $req_type,)
        {
            $a = explode("/", $route_name);
            $controller = $a[0];
            $metodo = $a[1];

            $type = array("ROUTE" => $route_name, "CONTROLLER" => $controller, "METODO" => $metodo, "TYPE" => $req_type);
            array_push(self::$rotas, $type) or die("Não foi possível adicionar a rota solicitada");
            return true;
        }

        public static function get($route_name)
        {
            $rotas = json_decode(self::getAll());

            foreach ( $rotas as $rota )
            {
                if ($rota->ROUTE == $route_name)
                {
                    self::$req_type = $rota->TYPE;
                }
            }

            if(!empty(self::$req_type))
            {
                return self::$req_type;
            }else {
                return false;
            }
        }

        public static function getAll()
        {
            self::loaderAll();
            return json_encode(self::$rotas);
        }

    }

?>