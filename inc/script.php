<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./assets/dist/js/axios.min.js"></script>
<script src="./assets/dist/js/vue.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-logout').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: './action/logout-action.php',
                        success: function(data) {
                            window.location.href = "http://localhost/stock-learning/index.php?logout_message=" + data.logout_message;
                        },
                    })
                }
            })
        })
        <?php
        if (isset($_GET['logout_message'])) {
        ?>
            Swal.fire('<?php echo ($_GET['logout_message']); ?>');
        <?php
        }
        ?>
    })
</script>