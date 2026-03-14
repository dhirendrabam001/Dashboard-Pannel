<?php
// flash.php
function flash($type = '', $message = '', $redirect = '')
{
    if ($message != '') {
        // Include SweetAlert only once
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '$type',
                    title: '" . ($type == 'success' ? 'Success' : 'Oops!') . "',
                    text: '$message',
                    confirmButtonText: 'OK'
                })";
        if ($redirect != '') {
            echo ".then(() => { window.location.href = '$redirect'; })";
        }
        echo ";
            });
        </script>";
    }
}
