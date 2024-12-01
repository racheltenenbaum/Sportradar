<?php

  require_once "Team.php";
  require_once "Venue.php";
  require_once "EventController.php";
  require_once "Event.php";
  $rows_teams = getTeams();
  $rows_venues = getVenues();

  $error = false;
  $datetimeErrorMsg = "";
  $teamErrorMsg = "";
  $descErrorMsg = "";

  if (isset($_POST["submit"])) {
    $check = checkEvent($_POST["datetime"], $_POST["team1"], $_POST["team2"], $_POST["venue"], $_POST["description"]);
    $datetimeErrorMsg = $check["datetimeErrorMsg"];
    $teamErrorMsg = $check["teamErrorMsg"];
    $descErrorMsg = $check["descErrorMsg"];
    if (!$check["error"]) {
      $event = createEvent($check["datetime"], $check["team1"], $check["team2"], $check["venue"], $check["description"]);
    }
    if (isset($event)) {
      $event->AddEvent($event);
    }
  }

?>
<?php include "components/header.php" ?>
<div class="main-div add-event">
  <h2 style="text-align: center;">Add New Event</h2>
  <form method="post">
    <label for="datetime" class="form-label">Date & Time:</label>
      <input type="datetime-local" class="form-control" name="datetime" placeholder="Date & Time" value="<?php if (isset($_POST["datetime"])) {echo $_POST["datetime"];}?>">
      <text class="error-msg"><?=$datetimeErrorMsg?></text>
    <label for="team1" class="form-label">Team:</label>
      <select class="form-select" name="team1">
        <?php
        foreach ($rows_teams as $key => $row_team) {
          if ($row_team["id"] == $_POST["team1"]) {
            echo "<option selected value='{$row_team["id"]}'>{$row_team["sport"]}: {$row_team["name"]}, {$row_team["city"]}</option>";
          } else {
            echo "<option value='{$row_team["id"]}'>{$row_team["sport"]}: {$row_team["name"]}, {$row_team["city"]}</option>";
          }
        } ?>
      </select>
    <label for="team2" class="form-label">vs. Team:</label>
      <select class="form-select" name="team2">
        <?php
        foreach ($rows_teams as $key => $row_team) {
          if ($row_team["id"] == $_POST["team2"]) {
            echo "<option selected value='{$row_team["id"]}'>{$row_team["sport"]}: {$row_team["name"]}, {$row_team["city"]}</option>";
          } else {
            echo "<option value='{$row_team["id"]}'>{$row_team["sport"]}: {$row_team["name"]}, {$row_team["city"]}</option>";
          }
        } ?>
      </select>
      <text class="error-msg"><?=$teamErrorMsg?></text>
    <label for="venue" class="form-label">Venue:</label>
      <select class="form-select" name="venue">
        <?php
        foreach ($rows_venues as $key => $row_venue) {
          if ($row_venue["id"] == $_POST["venue"]) {
            echo "<option selected value='{$row_venue["id"]}'>{$row_venue["name"]}, {$row_venue["city"]}</option>";
          } else {
            echo "<option value='{$row_venue["id"]}'>{$row_venue["name"]}, {$row_venue["city"]}</option>";
          }
        } ?>
      </select>
    <label for="description" class="form-label">Event description:</label>
    <input type="text" class="form-control" name="description" placeholder="description" value="<?php if (isset($_POST["description"])) {echo $_POST["description"];}?>">
    <text class="error-msg"><?=$descErrorMsg?></text>
    <input type="submit" class="btn btn-primary my-3" value="Create" name="submit">
  </form>
</div>
<?php include "components/footer.php" ?>
