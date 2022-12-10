<?php
session_start();

if (isset($_SESSION['CodigoInvalido'])) {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Código inválido'
            });
        </script>
        ";

    unset($_SESSION['CodigoInvalido']);
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
                        Receba algum link/arquivo
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

<section class="pt-3 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <form action="<?= MAIN_LINK ?>receber/r/content" method="post" id="confirm-code">
                    <h4 class="mt-3">Informe o código de recebimento:</h4>
                    <input type="text" class="form-control text-center" required name="codigo">
                    <br>
                </form>
                <button type="button" class="btn bg-gradient-warning" id="go">Validar</button>
            </div>
        </div>
    </div>
</section>

<script>
    $("#go").click(function() {

        var code = $("[name='codigo']").val();

        if (code != "") {

            $.ajax({
                url: "<?= MAIN_LINK ?>receber/r/info-content",
                method: "POST",
                data: {
                    codigo: code
                },
                success: function(res) {
                    var response = JSON.parse(res);

                    if (response.code == "404") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Código não encontrado!',
                        });

                        return;
                    } else {
                        var tipo = response.return.tipo;
                        if (tipo == "link") {
                            var link = response.return.link;
                            Swal.fire({
                                html: "Você realmente deseja ser redirecionado para <b>" + link + "</b> ?",
                                confirmButtonText: 'Abrir',
                                cancellButtonText: `Cancelar`,
                                showCancelButton: true

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#confirm-code").submit();
                                }
                            });
                            return;
                        } else {

                            var arquivo = response.return.nome_arquivo;
                            var deletado = response.return.is_deletado;

                            if(deletado == "0")
                            {
                                Swal.fire({
                                    html: "Você realmente deseja baixar o arquivo <b>" + arquivo + "</b>?",
                                    confirmButtonText: 'Baixar',
                                    cancellButtonText: `Cancelar`,
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#confirm-code").submit();
                                    }
                                });
    
                                return;
                            }else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    html: "O arquivo <b>" + arquivo + "</b> está expirado!",
                                });
    
                                return;
                            }
                        }
                    }
                },
                error: function(res) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocorreu um erro ao consultar o código informado, tente novamente mais tarde!',
                    });
                }
            });

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Informe um código!',
            });

            return;
        }

    });
</script>