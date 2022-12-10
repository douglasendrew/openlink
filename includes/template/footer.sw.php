    <!-- <footer class="text-center"
        style="bottom: 0; position: absolute;">
        Criado por <a href="https://linkedin.com/in/douglasendrew">Douglas Endrew</a>
    </footer> -->
    <?php
        use SimpleWork\Framework\Page\Site;
        define("ASSESTS", Site::$url_site . "includes/assets/");
    ?>
    <script src="<?= ASSESTS ?>js/core/popper.min.js" type="text/javascript"></script>

    <script src="<?= ASSESTS ?>js/core/bootstrap.min.js" type="text/javascript"></script>

    <script src="<?= ASSESTS ?>js/plugins/perfect-scrollbar.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/typedjs.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/countup.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/rellax.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/tilt.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/choices.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/parallax.min.js"></script>

    <script src="<?= ASSESTS ?>js/plugins/nouislider.min.js" type="text/javascript"></script>

    <script src="<?= ASSESTS ?>js/plugins/glidejs.min.js" type="text/javascript"></script>

    <script src="<?= ASSESTS ?>js/plugins/anime.min.js" type="text/javascript"></script>

    <script src="<?= ASSESTS ?>js/plugins/chartjs.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>

    <script src="<?= ASSESTS ?>js/soft-design-system-pro.min9f1e.js?v=1.1.0" type="text/javascript"></script>

    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"77604786f9ee022b","version":"2022.11.3","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}' crossorigin="anonymous"></script>

</body>
</html>