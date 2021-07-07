<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getUserByUsername($db,$id);
    echo '<table>
                <tr>
                <td>Username:</td>
                <td>'.$data['username'].'</td>
                </tr>
                <tr>
                <td>Password:</td>
                <td>'.$data['password'].'</td>
                </tr>
                <tr>
                <td>Email:</td>
                <td>'.$data['email'].'</td>
                </tr>
                <tr>
                <td>isAdmin:</td>
                <td>'.$data['isAdmin'].'</td>
                </tr>
            </table>';
?>