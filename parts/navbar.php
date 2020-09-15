<?php

$linkName=$_SERVER['PHP_SELF'];
$lsTeamName="/web_note/team.php";
$serverTeamName="/team.php";
$inTeam=false;
if(($linkName==$lsTeamName) || ($linkName==$serverTeamName)){
  $inTeam=true;
}

echo '<!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="https://miro.medium.com/max/3902/0*_FE5Q4eSYpBO-aps" 
    width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Web Note
  </a>';
if(!$inTeam){
  echo '<a class="btn btn-primary" href="team.php" role="button">Our Team</a>';
}
echo '</nav>';

?>