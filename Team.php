<?php

function getTeams() {
  include "components/connection.php";
  $sql = "SELECT Team.id as id, Team.name as name, Team.city as city, Sport.name as sport FROM Team Join Sport on Team.sport_id_fk = Sport.id";
  $result = mysqli_query($conn, $sql);
  $rows_teams = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows_teams;
}
