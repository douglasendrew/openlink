<?php
require __DIR__ . "/../../vendor/autoload.php";

use SimpleWork\Framework\Page\Site;
use SimpleWork\Core\Run;

define("ASSESTS", Site::$url_site . "includes/assets/");
define("MAIN_LINK", Site::$url_site);

date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="<?= ASSESTS ?>img/apple-icon.png">

    <link rel="icon" type="image/png" href="<?= ASSESTS ?>img/favicon.png">

    <title><?= Site::genTitlePage() ?></title>

    <meta name="keywords" content="abrir link no computador, abrir link no celular, ">

    <meta name="description" content="Abra links em seus dispositivos sem complexidade e gratuitamente!">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="<?= ASSESTS ?>css/nucleo-icons.css" rel="stylesheet" />

    <link href="<?= ASSESTS ?>css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/455a63c297.js" crossorigin="anonymous"></script>

    <link href="<?= ASSESTS ?>css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="<?= ASSESTS ?>css/soft-design-system-pro.min9f1e.css?v=1.1.0" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<style>
    .font_title {
        font-family: 'Satisfy', cursive;
    }
</style>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>

<body class="presentation-page">