<?php

function getSports() {
  include "components/connection.php";
  $sql = "SELECT * FROM Sport";
  $result = mysqli_query($conn, $sql);
  $rows_sports = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows_sports;
}
