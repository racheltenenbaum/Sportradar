<?php

  // cleanInput function to ensure data safety (against DB injection) for user input via forms
  function cleanInput($input)
  {
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function checkEvent() {
    include "components/connection.php";
    $error = false;
    $datetimeErrorMsg = "";
    $teamErrorMsg = "";
    $descErrorMsg = "";

    $datetime = $_POST["datetime"];
    $team1 = $_POST["team1"];
    $team2 = $_POST["team2"];
    $venue = $_POST["venue"];
    $description = cleanInput($_POST["description"]);

    if (empty($datetime)) {
      $error = true;
      $datetimeErrorMsg = "Please select a date and time<br>";
    }

    // query to retrieve the sports of the teams selected, to test if they match (otherwise error)
    $sql = "SELECT sport_id_fk as sport FROM Team WHERE id = $team1 OR id = $team2";
    $result = mysqli_query($conn, $sql);
    $rows_sport = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($team1 == $team2) {
      $error = true;
      $teamErrorMsg = "Please select two different teams!<br>";
    } elseif ($rows_sport[0]["sport"] != $rows_sport[1]["sport"]) {
      $error = true;
      $teamErrorMsg = "Teams must play the same sport!<br>";
    }

    if (empty($description)) {
      $error = true;
      $descErrorMsg = "Please include an event description<br>";
    }

    return ["error" => $error, "datetimeErrorMsg" => $datetimeErrorMsg, "teamErrorMsg" => $teamErrorMsg, "descErrorMsg" => $descErrorMsg, "datetime" => $datetime, "team1" => $team1, "team2" => $team2, "venue" => $venue, "description" => $description];
  }

  function createEvent($datetime, $team1, $team2, $venue, $description) {
      $event = new Event($datetime, $team1, $team2, $venue, $description);
      return $event;
  }

// function to retrieve all the events (past and future) from the DB
  function eventIndex() {
  include "components/connection.php";
  $sql = "SELECT event.datetime as datetime,
          t1.name as t1_name,
          t2.name as t2_name,
          t1.logo as t1_logo,
          t2.logo as t2_logo,
          venue.name as ven_name,
          venue.city as ven_city,
          sport.icon as sport_icon
          FROM Event
          JOIN Venue on venue.id = event.venue_id_fk
          JOIN Team t1 on event.team_1_id_fk = t1.id
          JOIN Team t2 on event.team_2_id_fk = t2.id
          JOIN Sport on t1.sport_id_fk = sport.id
          ORDER BY datetime ASC";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
  }

  // function to retrieve filtered events by the user
  // alters the DB query based on info inputted/not inputted by the user
  function eventFilterIndex($sport, $start_date, $end_date) {
    include "components/connection.php";
    if ($sport != "All Sports") {
      if ((!empty($start_date)) && (!empty($end_date))) {
        $sql = "SELECT event.datetime as datetime,
          t1.name as t1_name,
          t2.name as t2_name,
          t1.logo as t1_logo,
          t2.logo as t2_logo,
          venue.name as ven_name,
          venue.city as ven_city,
          sport.icon as sport_icon,
          sport.name
          FROM Event
          JOIN Venue on venue.id = event.venue_id_fk
          JOIN Team t1 on event.team_1_id_fk = t1.id
          JOIN Team t2 on event.team_2_id_fk = t2.id
          JOIN Sport on t1.sport_id_fk = sport.id
          WHERE sport.name = '$sport'
          AND (datetime > '$start_date' OR datetime < '$end_date')
          ORDER BY datetime ASC";
      } elseif ((!empty($start_date)) && (empty($end_date))) {
          $sql = "SELECT event.datetime as datetime,
          t1.name as t1_name,
          t2.name as t2_name,
          t1.logo as t1_logo,
          t2.logo as t2_logo,
          venue.name as ven_name,
          venue.city as ven_city,
          sport.icon as sport_icon,
          sport.name
          FROM Event
          JOIN Venue on venue.id = event.venue_id_fk
          JOIN Team t1 on event.team_1_id_fk = t1.id
          JOIN Team t2 on event.team_2_id_fk = t2.id
          JOIN Sport on t1.sport_id_fk = sport.id
          WHERE sport.name = '$sport'
          AND datetime > '$start_date'
          ORDER BY datetime ASC";
      } elseif ((empty($start_date)) && (!empty($end_date))) {
        $sql = "SELECT event.datetime as datetime,
            t1.name as t1_name,
            t2.name as t2_name,
            t1.logo as t1_logo,
            t2.logo as t2_logo,
            venue.name as ven_name,
            venue.city as ven_city,
            sport.icon as sport_icon,
            sport.name
            FROM Event
            JOIN Venue on venue.id = event.venue_id_fk
            JOIN Team t1 on event.team_1_id_fk = t1.id
            JOIN Team t2 on event.team_2_id_fk = t2.id
            JOIN Sport on t1.sport_id_fk = sport.id
            WHERE sport.name = '$sport'
            AND datetime < '$end_date'
            ORDER BY datetime ASC";
      } else {
        $sql = "SELECT event.datetime as datetime,
        t1.name as t1_name,
        t2.name as t2_name,
        t1.logo as t1_logo,
        t2.logo as t2_logo,
        venue.name as ven_name,
        venue.city as ven_city,
        sport.icon as sport_icon,
        sport.name
        FROM Event
        JOIN Venue on venue.id = event.venue_id_fk
        JOIN Team t1 on event.team_1_id_fk = t1.id
        JOIN Team t2 on event.team_2_id_fk = t2.id
        JOIN Sport on t1.sport_id_fk = sport.id
        WHERE sport.name = '$sport'
        ORDER BY datetime ASC";
      }
    } else {
        if ((!empty($start_date)) && (!empty($end_date))){
          $sql = "SELECT event.datetime as datetime,
            t1.name as t1_name,
            t2.name as t2_name,
            t1.logo as t1_logo,
            t2.logo as t2_logo,
            venue.name as ven_name,
            venue.city as ven_city,
            sport.icon as sport_icon,
            sport.name
            FROM Event
            JOIN Venue on venue.id = event.venue_id_fk
            JOIN Team t1 on event.team_1_id_fk = t1.id
            JOIN Team t2 on event.team_2_id_fk = t2.id
            JOIN Sport on t1.sport_id_fk = sport.id
            WHERE (datetime > '$start_date' OR datetime < '$end_date')
            ORDER BY datetime ASC";
        } elseif ((!empty($start_date)) && (empty($end_date))) {
          $sql = "SELECT event.datetime as datetime,
          t1.name as t1_name,
          t2.name as t2_name,
          t1.logo as t1_logo,
          t2.logo as t2_logo,
          venue.name as ven_name,
          venue.city as ven_city,
          sport.icon as sport_icon,
          sport.name
          FROM Event
          JOIN Venue on venue.id = event.venue_id_fk
          JOIN Team t1 on event.team_1_id_fk = t1.id
          JOIN Team t2 on event.team_2_id_fk = t2.id
          JOIN Sport on t1.sport_id_fk = sport.id
          WHERE datetime > '$start_date'
          ORDER BY datetime ASC";
        } elseif ((empty($start_date)) && (!empty($end_date))) {
          $sql = "SELECT event.datetime as datetime,
          t1.name as t1_name,
          t2.name as t2_name,
          t1.logo as t1_logo,
          t2.logo as t2_logo,
          venue.name as ven_name,
          venue.city as ven_city,
          sport.icon as sport_icon,
          sport.name
          FROM Event
          JOIN Venue on venue.id = event.venue_id_fk
          JOIN Team t1 on event.team_1_id_fk = t1.id
          JOIN Team t2 on event.team_2_id_fk = t2.id
          JOIN Sport on t1.sport_id_fk = sport.id
          WHERE datetime < '$end_date'
          ORDER BY datetime ASC";
        }
      };
      $result = mysqli_query($conn, $sql);
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      return $rows;
      if (!isset($sql)) {
        return eventIndex();
      }
    }
