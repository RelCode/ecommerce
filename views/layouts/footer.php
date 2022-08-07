    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap-4.6.1/bootstrap.min.js"></script>
    <script src="./assets/sweetalert/sweetalert.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <?php
        if(isset($_SESSION['swal'])){
            ?>
                <script>
                    swal({
                        icon:'<?= $_SESSION['swal']['icon'] ?>',
                        title:'<?= $_SESSION['swal']['title'] ?>',
                        text:'<?= $_SESSION['swal']['text'] ?>'
                    }).then((closed) => {
                        window.location.href = '/ecommerce';
                    })
                </script>
            <?php
        }
    ?>
</body>
</html>