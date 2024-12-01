<?php
  require_once "EventController.php";
  require_once "Sport.php";
  $rows_sports = getSports();
  $events = eventIndex();

  // event filter passing through the url
  if (isset($_POST["filter"])) {
    header("refresh: 0; url= 'event_results.php?sport={$_POST["sport"]}&start_date={$_POST["start_date"]}&end_date={$_POST["end_date"]}'");
  }

?>
<?php include "components/header.php" ?>
<h1>Event Schedule</h1>
<a href="create_event.php" class="btn btn-primary" style="justify-content:right">Add Event</a>
<div class="main-div">
  <div class="d-flex mb-4" style="justify-content: space-between;">
    <h2>Upcoming Events</h2>
    <div>
      <form method="post">
        <div class="d-flex">
          <div>
            <select class="form-select form-field" name="sport">
              <option value='All Sports'>All Sports</option>";
              <?php
              foreach ($rows_sports as $key => $row_sport) {
                echo "<option value='{$row_sport["name"]}'>{$row_sport["name"]}</option>";
              } ?>
            </select>
            <div class="d-flex" style="justify-content: space-between;">
              <label for="start_time">From: </label><br>
              <input type="datetime-local" class="form-control ms-2 mt-2 form-field" style="width:130px" name="start_date" placeholder="Date & Time">
            </div>
            <div class="d-flex" style="justify-content: space-between;">
              <label for="start_time">Until: </label><br>
              <input type="datetime-local" class="form-control ms-2 mt-2 form-field" style="width:130px" name="end_date" placeholder="Date & Time">
            </div>
          </div>
          <div>
            <input type="submit" class="btn btn-primary ms-2" value="filter" style="height:100%" name="filter">
          </div>
        </div>
      </form>
    </div>
  </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($events as $key => $event):?>
        <?php $datetime = new DateTime($event["datetime"]);?>
        <div><div class="card">
          <div class="d-flex card-header" style="justify-content:space-between">
            <div>
              <?=$datetime->format('D, j M Y')?>
            </div>
            <div>
              <?=$datetime->format('g:i a')?>
            </div>
          </div>
          <img src="<?=$event["sport_icon"]?>" class="card-img-top" alt="game">
          <div class="card-body">
            <p class="venue-text"><i class="fa-solid fa-map-pin"></i>  <?=$event["ven_name"]?>, <?=$event["ven_city"]?></p>
            <div class="d-flex mb-2" style="justify-content: space-between; align-items:center";>
              <div>
                <img src="<?=$event["t1_logo"]?>" alt="<?=$event["t1_name"]?>" class="logo-img">
              </div>
              <div>
                <text>VS.</text>
              </div>
              <div>
                <img src="<?=$event["t2_logo"]?>" alt="<?=$event["t2_name"]?>" class="logo-img">
              </div>
            </div>
            <div class="d-flex" style="justify-content: space-between;">
              <div>
                <text class="team-text"><?=$event["t1_name"]?></text>
              </div>
              <div>
                <text class="team-text"><?=$event["t2_name"]?></text>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php include "components/footer.php" ?>
