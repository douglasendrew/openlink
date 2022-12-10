<?php

use SimpleWork\Framework\Database\Db;
use SimpleWork\Framework\Page\Hash;
use SimpleWork\Framework\Page\Site;

session_start();

if (!isset($_SESSION['Tipo'])) {
    Site::redirect("enviar");
}
?>
<header class="header-2">
    <div class="page-header min-vh-50 relative">
        <span class="mask bg-gradient-warning"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5 font_title">OpenLink</h1>
                    <p class="lead text-white mt-3">
                    <div class="mt-4">
                        <a href="<?= MAIN_LINK ?>" class="btn bg-gradient-warning">Voltar</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute w-100 z-index-1 bottom-0">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="moving-waves">
                    <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                    <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                    <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                    <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
                </g>
            </svg>
        </div>
    </div>
</header>

<?php
if ($_SESSION['Tipo'] == "link") :
    $select = Db::select(["*"], "arquivos_links", ["identificacao" => Hash::encode($_SESSION['IdentificacaoLink'])], []);
    if (!$select) :
?>
        <section class="pt-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c4b9.png" alt="" width="75vw">
                        <h2 class="mt-3">Algo deu errado!</h2>

                        <div class="mt-5">Não foi possivel criar o link direto... Mas você pode tentar novamente :)</div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    else :
        $result = $select->fetch();
        $link = Hash::decode($result['arquivo_link']);
        $link_qrcode = MAIN_LINK . "receber/c/" . $_SESSION['IdentificacaoLink']
    ?>
        <section class="pt-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://imagensemoldes.com.br/wp-content/uploads/2018/06/Emoji-Feliz-PNG.png" alt="" width="75vw">
                        <h2 class="mt-3">Deu certo!</h2>

                        <div class="mt-5">O ID do seu link é:</div>
                        <code class="h4">
                            <span id="copy_id"><?= $_SESSION['IdentificacaoLink'] ?></span>
                        </code>

                        <hr>

                        <div class="mt-5">Caso queira compartilhar com alguem:</div>
                        <code class="h4">
                            <span id="copy_id"><?= $link_qrcode ?></span>
                        </code>

                        <hr>

                        <div class="mt-5">Caso quiser abrir o link no celular, leia o QR Code abaixo:</div>
                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $link_qrcode ?>" alt="">

                    </div>
                </div>
            </div>
        </section>
    <?php
    endif;
else :
    $select = Db::select(["*"], "arquivos_links", ["identificacao" => Hash::encode($_SESSION['IdentificacaoArquivo'])], []);
    if (!$select) :
    ?>
        <section class="pt-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c4b9.png" alt="" width="75vw">
                        <h2 class="mt-3">Algo deu errado!</h2>

                        <div class="mt-5">Não foi possivel criar o link direto... Mas você pode tentar novamente :)</div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    else :
        $result = $select->fetch();
        $link = Hash::decode($result['arquivo_link']);
        $link_qrcode = MAIN_LINK . "receber/c/" . $_SESSION['IdentificacaoArquivo']
    ?>
        <section class="pt-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://imagensemoldes.com.br/wp-content/uploads/2018/06/Emoji-Feliz-PNG.png" alt="" width="75vw">
                        <h2 class="mt-3">Deu certo!</h2>

                        <div class="mt-5">O ID do seu arquivo é:</div>
                        <code class="h4">
                            <span id="copy_id"><?= $_SESSION['IdentificacaoArquivo'] ?></span>
                        </code>

                        <hr>

                        <div class="mt-5">Caso queira compartilhar com alguem:</div>
                        <code class="h4">
                            <span id="copy_id"><?= $link_qrcode ?></span>
                        </code>

                        <hr>

                        <div class="mt-5">Caso quiser abrir o link no celular, leia o QR Code abaixo:</div>
                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $link_qrcode ?>" alt="">

                    </div>
                </div>
            </div>
        </section>
<?php
    endif;
endif;
?>


<script>
    $("#copiar").click(function() {
        Toast.fire({
            icon: 'success',
            title: 'Copiado com '
        });
    });
</script>