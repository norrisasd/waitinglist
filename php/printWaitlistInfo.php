<?php
    require 'functions.php';
    $id=$_GET['id'];
    $data=getListById($db,$id);
    echo '<table>
                <tr>
                <td>ID:</td>
                <td>'.$data['waitlist_id'].'</td>
                </tr>
                <tr>
                <td>Name:</td>
                <td>'.$data['name'].'</td>
                </tr>
                <tr>
                <td>Phone:</td>
                <td>'.$data['phone'].'</td>
                </tr>
                <tr>
                <td>Email:</td>
                <td>'.$data['email'].'</td>
                </tr>
                <tr>
                <td>Start Date:</td>
                <td>'.$data['waitlist_start_date'].'</td>
                </tr>
                <tr>
                <td>End Date:</td>
                <td>'.$data['waitlist_end_date'].'</td>
                </tr>
                <tr>
                <td>Passengers:</td>
                <td>'.$data['waitlist_num_passengers'].'</td>
                </tr>
                <tr>
                <td>Service:</td>
                <td>'.$data['waitlist_activity_name'].'</td>
                </tr>
                <tr>
                <td>Notes:</td>
                <td>'.$data['waitlist_notes'].'</td>
                </tr>
                <tr>
                <td>Date Created: </td>
                <td>'.$data['waitlist_date_created'].'</td>
                </tr>
                <tr>
                <td>Enabled:</td>
                <td>'.$data['waitlist_enabled'].'</td>
                </tr>
                <tr>
                <td>Approval Sent: </td>
                <td>'.$data['waitlist_approval_sent'].'</td>
                </tr>
            </table>';
?>