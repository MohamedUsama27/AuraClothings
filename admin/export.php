<?php
include("../connection.php");

$query = mysqli_query($con, "SELECT * FROM `newsletter`");

$data = '
 <table border="1">
    <thead> 
        <tr>
            <td>Id</td>
            <td>Email</td>
            <td>Added Date</td>
        </tr>   
    </thead>
    <tbody>
';  

while($row = mysqli_fetch_assoc($query)) {
    $data .= "
        <tr class='mng'>
            <td>{$row['id']}</td>
            <td>{$row['email']}</td>
            <td>{$row['date']}</td>
        </tr>
    "; 
}

$data .= '       
    </tbody>
</table>
'; 

$name="newsletter - ".date("d-m-Y");


header ("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$name.xls");

echo $data;

?>
