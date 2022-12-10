<?php

    namespace SimpleWork\Framework\Controllers;

    use SimpleWork\Framework\Page\Site;

    class errorController extends MainController
    {

        public function error404()
        {
            Site::page_name("404");
            $this->view("error/404.php", []);
        }

        public function errorRotas()
        {
            $this->view("error/noRotas.php", []);
        }

        public function errorPost()
        {
            echo "Sorry, this route only support POST method.";
        }

    }