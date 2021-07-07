<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getClientById($db,$id);
    echo '<table>
                <tr>
                <td>ID:</td>
                <td>'.$data['client_id'].'</td>
                </tr>
                <tr>
                <td>Name:</td>
                <td>'.$data['client_name'].'</td>
                </tr>
                <tr>
                <td>Phone:</td>
                <td>'.$data['client_phone'].'</td>
                </tr>
                <tr>
                <td>Email:</td>
                <td>'.$data['client_email'].'</td>
                </tr>
                <tr>
                <td>Date Created:</td>
                <td>'.$data['client_date_created'].'</td>
                </tr>
                <tr>
                <td>DND:</td>
                <td>'.$data['client_dnd'].'</td>
                </tr>
                <tr>
                <td>Enabled:</td>
                <td>'.$data['client_enabled'].'</td>
                </tr>
                <tr>
            </table>';
?>