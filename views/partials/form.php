<form action="forecast.php" method="post">
  <div class="form-group">
    <label class="sr-only" for="location1">Location1</label>
    <input type="text" class="form-control" id="location1" aria-describedby="location-help" placeholder="Location 1" name="location1" value="<?php echo (isset($_POST['location1']) ? $_POST['location1'] : '') ?>">
  </div>
    <div class="form-group">
    <label class="sr-only" for="location2">Location2</label>
    <input type="text" class="form-control" id="location2" aria-describedby="location-help" placeholder="Location 2" name="location2" value="<?php echo (isset($_POST['location2']) ? $_POST['location2'] : '') ?>">
  </div>
    <div class="form-group">
    <label class="sr-only" for="location3">Location3</label>
    <input type="text" class="form-control" id="location3" aria-describedby="location-help" placeholder="Location 3" name="location3" value="<?php echo (isset($_POST['location3']) ? $_POST['location3'] : '') ?>">
  </div>
  <button type="submit" name="submit" class="btn">Submit</button>
</form>

