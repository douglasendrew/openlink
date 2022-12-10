<?php

namespace SimpleWork\Framework\Controllers;

use SimpleWork\Framework\Database\Db;
use SimpleWork\Framework\Models\usuariosModel as Usuarios;
use SimpleWork\Framework\Page\Hash;
use SimpleWork\Framework\Page\Site;
use SimpleWork\Framework\Page\Request as req;

class receberController extends MainController
{

    public function index()
    {
        Site::page_name("Receber");
        $this->view("receber/receberIndexView", []);
    }

    public function setArchiveExpired($indentificacao)
    {
        $up = Db::update("arquivos_links", ["deletado" => "1"], ["identificacao" => Hash::encode($indentificacao)]);
        if($up)
        {
            return true;
        }else {
            return false;
        }
    }

    // => Retorna se o arquivo está expirado ou não.
    public function isExpiredArchive($indentificacao)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $TempoExpiracaoArquivo = 3600; // 1 hora em segundos

        $sel = Db::select(["*"], "arquivos_links", ["identificacao" => Hash::encode($indentificacao)], []);
        if(!$sel)
        {
            return;
        }else {
            $return = $sel->fetchAll()[0];
            $HoraCriacao = $return['date_created'];

            $time = strtotime($HoraCriacao) + $TempoExpiracaoArquivo;
            $HoraExpiracao = date('Y-m-d H:i:s', $time); 
            $Agora = date('Y-m-d H:i:s');
            
            if(strtotime($Agora) > strtotime($HoraExpiracao))
            {
                // Expirado
                $this->setArchiveExpired($indentificacao);
                
                $LinkArquivo = Hash::decode($return['arquivo_link']);
                $dir = "$LinkArquivo";
                if(unlink($dir))
                {
                }else{
                }

                return true;
            }else {
                // Não Expirado
                return false;
            }
            
        }

    }


    public function r($param)
    {
        date_default_timezone_set('America/Sao_Paulo');

        Site::page_name("a");

        session_start();

        $tipoR = $param[0];

        if($tipoR == "content")
        {
            $codigo = (isset($_POST['codigo'])) ? Hash::encode(strtoupper($_POST['codigo'])) : Hash::encode(strtoupper($_GET['codigo']));
            $select = Db::select(["*"], "arquivos_links", ["identificacao" => $codigo], []);
            if(!$select)
            {
                $_SESSION['CodigoInvalido'] = true;
                Site::redirect("receber");
            }else {
                $data = $select->fetchAll();
                $tipo = Hash::decode($data[0]['tipo']);

                if($tipo == "link")
                {
                    $link = $data[0]['arquivo_link'];
                    Site::redirect("receber/r/redirecionar/$link");
                }else if($tipo == "arquivo")
                {
                    $link = Hash::decode($data[0]['arquivo_link']);
                    $name = Hash::decode($data[0]['nome_arquivo']);

                    header('Content-Disposition: attachment; filename='.$name);
                    
                    header('Pragma: no-cache');

                    readfile("$link");

                    $_SESSION['DownloadEfetuado'] = true;
                    $_SESSION['DownloadEfetuado']['NomeArquivo'] = $name;
                    Site::redirect("receber");

                }else {
                    $_SESSION['CodigoInvalido'] = true;
                    Site::redirect("receber");
                }
            }
        }
        

        else if($tipoR == "redirecionar"){
            $link = Hash::decode($param[1]);
            
            echo "Redirecionando aguarde!";
            echo "
            <title>Redirecionando...</title>
            <script>
                setTimeout(function() {
                    window.location.href = '".Site::$url_site."receber';
                }, 1500);
                var win = window.open('$link', '_blank');  win.focus();
            </script>";
            exit;
        }
        

        else if($tipoR == "info-content"){

            $link = Hash::decode($param[1]);

            $codigo = (isset($_POST['codigo'])) ? Hash::encode(strtoupper($_POST['codigo'])) : Hash::encode(strtoupper($_GET['codigo']));

            $select = Db::select(["*"], "arquivos_links", ["identificacao" => $codigo], []);
            if(!$select)
            {
                $return = array("code" => "404", "return" => "Code not exists"); 
                print_r(json_encode($return));
                exit;
            }else {
                $data = $select->fetchAll()[0];
                if(Hash::decode($data['tipo']) == "link")
                {
                    $return = array(
                        "code" => "200", 
                        "return" => array(
                            "tipo" => Hash::decode($data['tipo']),
                            "link" => Hash::decode($data['arquivo_link']),
                        )
                    ); 
                }else {

                    $is_deletado = $data['deletado'];

                    if($this->isExpiredArchive(Hash::decode($codigo)))
                    {
                        $is_deletado = '1';
                    }

                    $return = array(
                        "code" => "200", 
                        "return" => array(
                            "tipo" => Hash::decode($data['tipo']),
                            "nome_arquivo" => Hash::decode($data['nome_arquivo']),
                            "is_deletado" => $is_deletado
                        )
                    ); 
                }
                print_r(json_encode($return));
                exit;
            }

        }
        
        else {
            Site::redirect("receber");
        }

    }
    
    public function c($param)
    {
        $link = $param[0];
        if(isset($link))
        {
            Site::redirect("receber/r/content?codigo=$link");
        }else {
            Site::redirect("receber");
        }
    }

    public function link($param)
    {
        $link = $param[0];
        if(isset($link))
        {
            Site::redirect("receber/r/content?codigo=$link");
        }else {
            Site::redirect("receber");
        }
    }
}
