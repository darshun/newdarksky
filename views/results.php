<?php include 'partials/header.php'; ?>
<pre>
<!--   <?php //print_r($forecast); ?> -->
</pre>
<main class="container py-5 text-center">
  <h1>
    BoomBox Weather
  </h1>
  <div class="text-left py-5 mx-auto" style="max-width: 320px;">
    <?php include 'partials/form.php'; ?>
  </div>
<!-- 1st forecast -->
  <div class="card p-4 my-5 mx-auto" style="max-width: 320px;">
    <p class="lead text-bold m-0"><?php echo $place1; ?></p>
    <h2 class="display-1 mb-0">
      <?php echo round($forecast1['currently']['temperature']); ?>&deg;
    </h2>
    <p class="lead">
      <?php echo $forecast1['currently']['summary']; ?>
    </p>
    <p class="lead">
      Wind Speed: <?php echo round($forecast1['currently']['windSpeed']); ?> MPH
    </p>
<!-- 2nd -->
    <p class="lead text-bold m-0"><?php echo $place2; ?></p>
    <h2 class="display-1 mb-0">
      <?php echo round($forecast2['currently']['temperature']); ?>&deg;
    </h2>
    <p class="lead">
      <?php echo $forecast2['currently']['summary']; ?>
    </p>
    <p class="lead">
      Wind Speed: <?php echo round($forecast2['currently']['windSpeed']); ?> 
<!-- 3rd -->
    <p class="lead text-bold m-0"><?php echo $place3; ?></p>
    <h2 class="display-1 mb-0">
      <?php echo round($forecast3['currently']['temperature']); ?>&deg;
    </h2>
    <p class="lead">
      <?php echo $forecast3['currently']['summary']; ?>
    </p>
    <p class="lead">
      Wind Speed: <?php echo round($forecast3['currently']['windSpeed']); ?> 
  </div>


  <div class="row">
    <?php foreach($forecast1['daily']['data'] as $day): ?>
      <div class="col-12 col-md-4">
        <div class="card p-4 my-5 mx-auto"">
          <p class="lead m-0">
            <?php echo gmdate("l", $day['time']); ?> 
            <!-- l gives the day of wk,
            d gives the abbrev -->
          </p>
          <h2 class="m-0">
            <?php echo round($day['temperatureHigh']); ?>&deg;
          </h2>
          <p class="lead text-left">
            <?php echo $day['summary']; ?>
          </p>
        </div>
      </div>
  <?php endforeach; ?>



    <!-- SPOTIFY -->
<?php
  if($forecast1['currently']['temperature'] >= 40 && $forecast1['currently']['temperature'] <= 50){echo $playlist = 'freezing';
  } elseif($forecast1['currently']['temperature'] >= 51 && $forecast1['currently']['temperature'] <= 70){echo $playlist = 'cold';
  } elseif($forecast1['currently']['temperature'] >= 71 && $forecast1['currently']['temperature'] <= 80){echo $playlist = 'warm';
  } elseif($forecast1['currently']['temperature'] >= 81 && $forecast1['currently']['temperature'] <= 90){echo $playlist = 'hot';
  }

  require_once 'vendor/autoload.php';

  $session = new SpotifyWebAPI\Session(
    '27d6b0df03194949b6b8ac6abcf7a1db', 'a4fe6e26715046f68fb987c5aa837396'
  );

  $api = new SpotifyWebAPI\SpotifyWebAPI();

  $session->requestCredentialsToken();
  $accessToken = $session->getAccessToken();

  // Set the code on the API wrapper
  $api->setAccessToken($accessToken);

  $playlist_term = '$playlist';

  $results = $api->search($playlist_term, 'playlist');

  // echo '<pre>';
  // print_r($results);
  // echo '</pre>';
  $results = json_decode(json_encode($results));
?>
    <header class="bg-dark container-fluid py-4 text-center text-white">
      <h1 class="display-4 m-0">
        Boombox Weather Playlists
      </h1>
    </header>
        <main class="container my-5">
      <h2 class="display-3 py-4"><?php echo ucfirst($playlist_term); ?></h2>

      <section class="row">

      <?php foreach ($results->playlists->items as $playlist): ?>
        <div class="col-12 col-md-4 mb-4">
          <img class="img-fluid" src="<?php echo $playlist->images[0]->url;?>" width="320" height="320">
          <h2 class="h4 m-0">
            <a href="<?php echo $playlist->uri; ?>">
<!-- take out "external_urls->" for web player-->
              <?php echo $playlist->name; ?></h2>
            </a>
          </h2>
        </div>
      <?php endforeach; ?>

      </section>
  </div>
</main>
<?php include 'partials/footer.php'; ?>