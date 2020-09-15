<?php

echo '<form action="index.php" method="post">
<div class="form-group">
  <label for="exampleInputEmail1">Title</label>
  <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Note</label>
    <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
  </div>
<button type="submit" class="btn btn-primary">Add Note</button>
</form>';

?>