<div class="card">
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
