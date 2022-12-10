<?php

    namespace SimpleWork\Framework\Controllers;

    use SimpleWork\Framework\Database\Db;
    use SimpleWork\Framework\Models\usuariosModel as Usuarios;
    use SimpleWork\Framework\Page\Site;
    use SimpleWork\Framework\Page\Request as req;

    class homeController extends MainController
    {
        public function index()
        {
            Site::page_name("Home");
            
            $this->view("home/homeView", [
                "version" => "v1.0",
                "author" => "Douglas Endrew",
                "link_github" => "https://github.com/douglasendrew",
                "link_simplework" => "https://github.com/douglasendrew/SimpleWork"
            ]);
        }
    }