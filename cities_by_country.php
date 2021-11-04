<?php
require_once '../config/connect_db.php';
$country_code = $_POST['country_code'];
$sql = "SELECT * FROM city WHERE `countryCode` = '$country_code'";
$result = mysqli_query($conn, $sql);
?>
<select>
  <option value="">Select a city</option>
  <?php while ($city = mysqli_fetch_array($result)) : ?>
    <option value="<?php echo $city["ID"]; ?>">
      <?php echo $city["Name"]; ?></option>
  <?php endwhile; ?>
</select>