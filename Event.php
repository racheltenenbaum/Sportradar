<?php

class Event {
  public $datetime;
  public $team1;
  public $team2;
  public $venue;
  public $description;

  public function __construct($datetime, $team1, $team2, $venue, $description)
  {
    $this->datetime = $datetime;
    $this->team1 = $team1;
    $this->team2 = $team2;
    $this->venue = $venue;
    $this->description = $description;
  }

  // function to commit new event (Event class instance) to database
  public function AddEvent(Event $event) {
    include "components/connection.php";
    $sql = "INSERT INTO `Event`(`datetime`, `team_1_id_fk`, `team_2_id_fk`, `venue_id_fk`, `description`) VALUES ('$event->datetime','$event->team1','$event->team2','$event->venue','$event->description')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "<div class='alert alert-success' role='alert'>
                New event added!
              </div>";
      } else {
        echo "<div class='alert alert-danger' role='alert'>
                Something went wrong, please try again later!
              </div>";
      }
    header("refresh: 1; url= 'index.php");
  }
}
