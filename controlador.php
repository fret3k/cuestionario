
<?php


    if (isset($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];

        echo $idCliente;
    
    } else {
        echo "ID del cliente fue proporcionado.";
    }
?>

