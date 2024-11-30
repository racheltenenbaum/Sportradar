<?php

function getVenues() {
  include "components/connection.php";
  $sql = "SELECT * FROM Venue";
  $result = mysqli_query($conn, $sql);
  $rows_venues = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows_venues;
}
