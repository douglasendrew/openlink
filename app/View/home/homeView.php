<?php

    use SimpleWork\Framework\Database\Db;
    use SimpleWork\Framework\Page\Hash;

    $links = Db::select(["*"], "arquivos_links", ["tipo" => Hash::encode("link")], [])
        ->fetchAll();

    $links = count($links);

    $arquivos = Db::select(["*"], "arquivos_links", ["tipo" => Hash::encode("arquivo")], [])
        ->fetchAll();

    $arquivos = count($arquivos);
?>

<header class="header-2">
    <div class="page-header min-vh-75 relative">
        <span class="mask bg-gradient-warning"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5 font_title">OpenLink</h1>
                    <p class="lead text-white mt-3">
                        Abra links em outros dispositivos de forma rapida e gratuita!
                    <div class="text-white">
                        <a class="btn btn-lg bg-gradient-info" href="<?= MAIN_LINK ?>enviar">Enviar para um dispositivo</a>
                        <div>Ou</div>
                        <a class="text-white btn btn-lg bg-success" href="<?= MAIN_LINK ?>receber">Receber de um dispositivo</a>
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

<section class="pt-3 pb-4" id="count-stats">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                <div class="row">
                    <div class="col-md-6 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-warning"><span id="state1" countto="<?= $links ?>"></span></h1>
                            <h5 class="mt-3">Links Abertos</h5>
                            </p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-6 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-warning"> <span id="state2" countto="<?= $arquivos ?>"></span></h1>
                            <h5 class="mt-3">Arquivos</h5>
                        </div>
                        <hr class="vertical dark">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>