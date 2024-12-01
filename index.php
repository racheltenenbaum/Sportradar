<?php
  require_once "EventController.php";
  require_once "Sport.php";
  $rows_sports = getSports();
  $events = eventIndex();

  // to determine if there are past events or not, so the "Past Events" h2 title will only show when relevant (this solution is to prevent performing additional DB queries)
  $past_events = 0;
  $past_header = "";
  foreach ($events as $key => $event) {
    if (new DateTime($event["datetime"]) < (new DateTime('now'))) {
      $past_events += 1;
    }
  }
  ($past_events >= 1)?$past_header="Past Events":"";

   // event filter POST passing through the url
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
        <?php
          $datetime = new DateTime($event["datetime"]);
          $now = new DateTime('now');
          if ($datetime >= $now) {?>
        <div><?php include "components/event_card.php" ?></div>
      <?php } endforeach; ?>
    </div>
    <h2 class="mt-5 mb-3"><?=$past_header?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($events as $key => $event):?>
        <?php
          $datetime = new DateTime($event["datetime"]);
          $now = new DateTime('now');
          if ($datetime < $now) {?>
        <div><?php include "components/event_card.php" ?></div>
      <?php } endforeach; ?>
    </div>
  </div>

  <?php include "components/footer.php" ?>
