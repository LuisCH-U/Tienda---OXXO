<?php

//comentado por que se usa en categorias headers
//include './Conexion/C_Bd_Conexion.php';

try {
    $conn = Obtener_Conexion_bd();

    $sql = "SELECT * FROM TA_PRODUCTOS ORDER BY RAND() LIMIT 12";
    //$sql = "SELECT ID_PRODUCTO, PRODUCTO, DESCRIPCION,IMAGEN,PRECIO  FROM TA_PRODUCTOS where id_producto in (1,2,3,4,5,6)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    //echo '<form class="c-form" action="" method="post">';
    if ($stmt->rowCount() > 0) {
        $num_rows = $stmt->rowCount();

        for ($i = 0; $i < $num_rows; $i++) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="card1 col-lg-2 col-6">';
            echo '<div class="card mb-4">';
            echo '<img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode($row['IMAGEN']) . '">';
            echo '<div class="card-body">';
            echo '<h6 class="card-title">' . htmlspecialchars($row['PRODUCTO']) . '</h6>';
            echo '<p class="card-text limited-text">' . htmlspecialchars($row['DESCRIPCION']) . '</p>';
            echo '<h6 class="card-text">' . 'S/' . htmlspecialchars($row['PRECIO']) . '</h6>';
            echo '<a class="btn_add" href="Agregando_Producto.php?ID_PRODUCTO=' . htmlspecialchars($row['ID_PRODUCTO']) . '">Agregar</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        //echo ' </form>';
    } else {
        echo "<div class='text-center'><b>No se encontraron productos. Pagina En Mantenimiento!</b></div>";
    }
    $conn = null;
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}