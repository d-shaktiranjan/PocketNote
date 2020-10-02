<?php

include 'dbconnect.php';

$mail=$_SESSION['mail'];
$ar=explode("@",$mail);
$name=$ar[0];

$sql="SELECT * FROM `$name`";
$result=mysqli_query($conn,$sql);

echo '<table class="table tableText" id="myTable">
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
    <td><pre>"."$row[note]"."</pre></td>
    <td><a href=\"parts/_delete.php?note_id=".$row['sno']."\" class=\"btn btn-primary\">Delete</a></td>
    </tr>";
    $slno++;
}

echo '</tbody>
</table>';

echo '<!-- Modal -->
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delModalLabel">Do you want to delete the note?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-danger">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nope</button>
      </div>
    </div>
  </div>
</div>';

?>