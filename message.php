<?php
    if (isset($_SESSION['message'])) :
?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Súper!',
                text: '<?= $_SESSION['message']; ?>',
                showCloseButton: true,
                confirmButtonText: 'Cerrar',
                allowOutsideClick: true,
                onClose: function() {
                    window.location.href = 'index.php';
            }});
        </script>
<?php
        unset($_SESSION['message']);
    endif;
?>
