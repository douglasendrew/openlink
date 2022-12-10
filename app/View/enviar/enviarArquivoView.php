<?php
if (isset($_SESSION['errorInserir'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel inserir, tente novamente mais tarde!',
            });
        </script>
    ";

    unset($_SESSION['errorInserir']);
}


if (isset($_SESSION['nenhumArquivo'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nenhum arquivo anexado! Por favor anexe um arquivo e tente novamente.',
            });
        </script>
    ";

    unset($_SESSION['nenhumArquivo']);
}


if (isset($_SESSION['nenhumLink'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nenhum link inserido! Por favor informe um link e tente novamente.',
            });
        </script>
    ";

    unset($_SESSION['nenhumLink']);
}


if (isset($_SESSION['TamanhoMaximoExcedido'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel fazer o upload. Tamanho máximo de 10mb excedido.',
            });
        </script>
    ";

    unset($_SESSION['TamanhoMaximoExcedido']);
}


if (isset($_SESSION['recaptchaInvalido'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'reCaptcha inválido, tente novamente!',
            });
        </script>
    ";

    unset($_SESSION['recaptchaInvalido']);
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
                        Enviar arquivo/link para algum dispositivo
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

<div class="modal fade" id="modal-recaptcha" tabindex="-1" role="dialog" aria-labelledby="modal-recaptcha" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Complete o recaptcha...</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="g-recaptcha d-flex align-items-center justify-content-center" data-sitekey="6LfWhhIjAAAAAK-NDw-xaeujM3DNaOADt01UUr6z"></div>

                <input type="button" class="btn bg-warning text-white mt-3" id="btn_send" value="Enviar" action="">
            </div>
        </div>
    </div>
</div>

<section class="pt-3 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="mt-3">Selecione o tipo de envio:</h4>
                <div class="form-check mb-3 mt-4">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="is_link">
                    <label class="custom-control-label fs-lg" for="customRadio1">
                        <h6>Link</h6>
                    </label>

                    <div id="div_is_link" style="display: none;" class="border p-3 rounded">
                        <div>Insira abaixo o link que deseja enviar:</div>
                        <form action="<?= MAIN_LINK ?>enviar/r/new-link" method="post" id="send-link">
                            <input type="text" hidden class="google" name="google_recaptcha">
                            <input type="url" class="form-control" name="link" required autocomplete="off">
                        </form>

                        <input type="button" class="btn bg-warning text-white mt-3" value="Enviar" data-bs-toggle="modal" data-bs-target="#modal-recaptcha" onclick="changeAction('link')">

                        <p class="text-muted">
                            * Qualquer pessoa com o código de acesso pode acessar seus links
                        </p>
                    </div>

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="is_arquivo">
                    <label class="custom-control-label fs-lg" for="customRadio2">
                        <h6>Arquivo</h6>
                    </label>

                    <div id="div_is_arquivo" style="display: none;" class="border p-3 rounded">
                        <div>Insira abaixo os arquivos que deseja enviar:</div>
                        <form action="<?= MAIN_LINK ?>enviar/r/new-archive" method="post" enctype="multipart/form-data" id="send-arquivo">
                            <input type="text" hidden class="google" name="google_recaptcha">
                            <input type="file" class="form-control" name="files" required autocomplete="off">
                        </form>

                        <input type="button" class="btn bg-warning text-white mt-3" value="Enviar" data-bs-toggle="modal" data-bs-target="#modal-recaptcha" onclick="changeAction('arquivo')">

                        <p class="text-muted">
                            * Qualquer pessoa com o código de acesso pode acessar seus arquivos <br>
                            * Máximo de 1 arquivo por upload <br>
                            * Máximo de no total 10MB <br>
                            * Arquivo excluido em 1 hora
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://www.google.com/recaptcha/enterprise.js?render=6LeHng0jAAAAAP8EmfSWgPWRWaQEd0iSNYZR_vMY"></script>

<script>

    function changeAction(action)
    {
        $("#btn_send").attr("action", action);
    }

    $("#is_link").change(function() {

        if ($("#is_link").is(":checked")) {

            $("#div_is_arquivo").hide();
            $("#div_is_link").show();

        } else {}

    });


    $("#is_arquivo").change(function() {

        if ($("#is_arquivo").is(":checked")) {

            $("#div_is_link").hide();
            $("#div_is_arquivo").show();

        } else {}

    });

    $("#btn_send").click(function() {
        var action = $("#btn_send").attr("action");

        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Não foi possivel validar o recaptcha.',
            });

            return;
        } else {

            if (action == "link") {
                $(".google").val(response);
                $("#send-link").submit();
            }else if(action == "arquivo")
            {
                $(".google").val(response);
                $("#send-arquivo").submit();
            }

            return;
        }
    });
</script>