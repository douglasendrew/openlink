<?php 

    use SimpleWork\Framework\Routes\Rotas;
    
    // Rota da Página Principal
    Rotas::set("home/index", "GET");


    // Links
    Rotas::set("enviar/index", "GET");
    Rotas::set("enviar/sucesso", "GET");
    Rotas::set("enviar/r/", "PUT");

    Rotas::set("receber/link/", "PUT");
    Rotas::set("receber/index", "GET");
    Rotas::set("receber/r/", "PUT");
    Rotas::set("receber/c/", "PUT");
