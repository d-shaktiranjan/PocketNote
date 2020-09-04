<?php

include 'dbconnect.php';

$mail=$_SESSION['mail'];
$ar=explode("@",$mail);
$name=$ar[0];

$sql="SELECT * FROM `$name`";
$result=mysqli_query($conn,$sql);

echo '<table class="table">
<thead class="thead-dark">
  <tr>
    <th scope="col">Sl. No.</th>
    <th scope="col">Tile</th>
    <th scope="col">Note</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>';

$slno=1;
while($row=mysqli_fetch_assoc($result)){

    echo "<tr>
    <th scope='row'>".$slno."</th>
    <td>"."$row[title]"."</td>
    <td>"."$row[note]"."</td>
    <td><button type=\"button\" class=\"btn btn-primary\">Delete</button></td>
    </tr>";
    $slno++;
}

echo '</tbody>
</table>';

?>