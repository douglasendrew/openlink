<?php

namespace SimpleWork\Framework\Controllers;

use SimpleWork\Framework\Database\Db;
use SimpleWork\Framework\Models\usuariosModel as Usuarios;
use SimpleWork\Framework\Page\Hash;
use SimpleWork\Framework\Page\Site;
use SimpleWork\Framework\Page\Request as req;

class enviarController extends MainController
{

    public function index()
    {
        Site::page_name("Enviar");
        $this->view("enviar/enviarArquivoView", []);
    }

    public function sucesso()
    {
        Site::page_name("Sucesso");
        $this->view("enviar/sucessoView", []);
    }

    public function r($req)
    {
        date_default_timezone_set('America/Sao_Paulo');
        
        session_start();
        session_destroy();
        session_start();

        $req_principal = $req[0];

        
        if($req_principal == "new-link")
        {
            if(Hash::valid_google_token($_POST['google_recaptcha']))
            {
                $LINK = $_POST['link'];
                $IDENTIFICACAO = strtoupper(uniqid('L'));
    
                if(empty($LINK) or !isset($LINK))
                {
                    $_SESSION['nenhumLink'] = true;
                    Site::redirect("enviar");
                }
    
                if(!Db::insert("arquivos_links", ["identificacao", "arquivo_link", "ip_created", "tipo"], [Hash::encode($IDENTIFICACAO), Hash::encode($LINK), Hash::encode($_SERVER['REMOTE_ADDR']), Hash::encode("link")]))
                {
                    $_SESSION['errorInserir'] = true;
                    Site::redirect("enviar");
                    exit;
                }else {
                    $_SESSION['IdentificacaoLink'] = $IDENTIFICACAO;
                    $_SESSION['LinkInserido'] = true;
                    $_SESSION['Link'] = $LINK;
                    $_SESSION['Tipo'] = 'link';
                    Site::redirect("enviar/sucesso");
                    exit;
                }
            }else {
                $_SESSION['recaptchaInvalido'] = true;
                Site::redirect("enviar");
            }
        }
        
        else if($req_principal == "new-archive")
        {
            if(Hash::valid_google_token($_POST['google_recaptcha']))
            {
                if(isset($_FILES['files']) && $_FILES['files']['error'] != 4 && $_FILES['files']['error'] == 0)
                {
                    $tmp_name = $_FILES['files']['tmp_name'];
                    $name = $_FILES['files']['full_path'];
                    $ext = ".".pathinfo($name, PATHINFO_EXTENSION);
                    $size = round(filesize($tmp_name) / 1024);
        
                    if($size > 10000)
                    {
                        $_SESSION['TamanhoMaximoExcedido'] = true;
                        Site::redirect("enviar");
                        exit;
                    }

                    $new_name = time() . $ext;
                    $dir = __DIR__ . "/../../../client_archives/";

                    if(move_uploaded_file($_FILES['files']['tmp_name'], $dir.$new_name))
                    {
                        $LinkArquivo = $dir.$new_name;
                        $IDENTIFICACAO = strtoupper(uniqid('L'));
            
                        if(!Db::insert("arquivos_links", 
                            [
                                "identificacao", 
                                "arquivo_link", 
                                "nome_arquivo",
                                "ip_created", 
                                "tipo"
                            ], 
                            [
                                Hash::encode($IDENTIFICACAO), 
                                Hash::encode($LinkArquivo), 
                                Hash::encode($name), 
                                Hash::encode($_SERVER['REMOTE_ADDR']), 
                                Hash::encode("arquivo")
                            ]
                        ))
                        {
                            $_SESSION['errorInserir'] = true;
                            Site::redirect("enviar");
                            exit;
                        }else {
                            $_SESSION['IdentificacaoArquivo'] = $IDENTIFICACAO;
                            $_SESSION['ArquivoInserido'] = true;
                            $_SESSION['Tipo'] = "arquivo";
                            Site::redirect("enviar/sucesso");
                            exit;
                        }
                    }else {
                        // echo "Erro: " . $_FILES["files"]["error"];
                    }

                    exit;

                }else {

                    $_SESSION['nenhumArquivo'] = true;
                    Site::redirect("enviar");

                }
            }else {
                $_SESSION['recaptchaInvalido'] = true;
                Site::redirect("enviar");
            }
        }
    }

}
