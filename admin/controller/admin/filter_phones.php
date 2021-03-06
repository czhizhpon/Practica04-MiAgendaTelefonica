<?php
    
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }

    include '../../../config/conexionBD.php';

    $keyword = $_GET['keyword'];
    $sqlPhones = "SELECT * FROM telefonos RIGHT JOIN usuarios ON telefonos.usu_codigo = usuarios.usu_codigo where (
        telefonos.tel_numero like '%$keyword%' or
        telefonos.tel_operadora like '%$keyword%' or
        telefonos.tel_tipo like '%$keyword' or 
        usuarios.usu_cedula like '%$keyword%' 
        )";
    
    $resultPh = $conn->query($sqlPhones);

    echo "<tr>
            <th>Número</th>
            <th>Tipo</th>
            <th>Operadora</th>
            <th>Eliminado</th>
            <th>U. Modificación</th>
            <th>CI. Usuario</th>
            <th></th>
        </tr>";

    if($resultPh){
        if ($resultPh -> num_rows > 0) {

            while($rowPh = $resultPh -> fetch_assoc()) {
                echo "<tr>";
                if(is_null($rowPh['tel_operadora']) == 1 ){
                    echo "<td><a class='a_link' href='create_phone.php'> REGISTRAR </a></td>";
                }else{
                    echo "<td><a class='a_link' href='tel:".  $rowPh['tel_numero'] . "'>" . $rowPh['tel_numero'] . "</a></td>";
                }

                switch($rowPh['tel_tipo']){
                    case "CO":
                        echo "<td> CONVENCIONAL</td>";
                    break;
                    case "CE":
                        echo "<td> CELULAR</td>";
                    break;
                    default:
                        echo "<td> </td>";
                }
                $company = ((is_null($rowPh['tel_operadora']) == 1 )? "" : $rowPh['tel_operadora']);
                echo "<td>" . $company  . "</td>";

                $tel_eliminado = ((is_null($rowPh['tel_eliminado']) == 1 )? "" : $rowPh['tel_eliminado']);
                echo "<td>" . $tel_eliminado . "</td>";
                echo "<td>" . $rowPh['tel_fecha_modificacion'] . "</td>";
                echo "<td>" . $rowPh['usu_cedula'] . "</td>";
                echo "<td> <a class='btn btn_passive' onclick='readAdminPhone(\"f_phone\", ". $rowPh['tel_codigo'] .")'>Administrar</a></td>";
                echo "</tr>";
                
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No se encontró.</td>";
        }
    }else{
        echo " <tr><td colspan='7'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>