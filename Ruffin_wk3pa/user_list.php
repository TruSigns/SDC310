<?php
// Connect to Database
$hostname = "127.0.0.1";
$username = "root";     // change if needed
$password = "";         // change if needed
$dbname   = "sdc310_wk3pa";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Variables for form and CRUD state
$userNo        = -1;
$fullName      = "";
$birthdate     = "";
$favoriteColor = "";
$favoritePlace = "";
$nickname      = "";

$add    = false;
$edit   = false;
$update = false;
$delete = false;

if (isset($_POST["user_no"])) {
  $userNo  = (int)$_POST["user_no"];
  $add     = isset($_POST["add"]);
  $edit    = isset($_POST["edit"]);
  $update  = isset($_POST["update"]);
  $delete  = isset($_POST["delete"]);
}

function esc(mysqli $conn, string $value): string {
  return mysqli_real_escape_string($conn, trim($value));
}

function clearForm(&$userNo, &$fullName, &$birthdate, &$favoriteColor, &$favoritePlace, &$nickname): void {
  $userNo        = -1;
  $fullName      = "";
  $birthdate     = "";
  $favoriteColor = "";
  $favoritePlace = "";
  $nickname      = "";
}

if ($add) {
  $fullName      = esc($conn, $_POST["full_name"] ?? "");
  $birthdate     = esc($conn, $_POST["birthdate"] ?? "");
  $favoriteColor = esc($conn, $_POST["favorite_color"] ?? "");
  $favoritePlace = esc($conn, $_POST["favorite_place"] ?? "");
  $nickname      = esc($conn, $_POST["nickname"] ?? "");

  $addQuery = "
    INSERT INTO personal_info (FullName, Birthdate, FavoriteColor, FavoritePlace, Nickname)
    VALUES ('$fullName', '$birthdate', '$favoriteColor', '$favoritePlace', '$nickname')
  ";
  mysqli_query($conn, $addQuery);

  clearForm($userNo, $fullName, $birthdate, $favoriteColor, $favoritePlace, $nickname);
}
else if ($edit) {
  $selQuery = "SELECT * FROM personal_info WHERE UserNo = $userNo";
  $result   = mysqli_query($conn, $selQuery);
  $row      = mysqli_fetch_assoc($result);

  if ($row) {
    $fullName      = $row["FullName"];
    $birthdate     = $row["Birthdate"];
    $favoriteColor = $row["FavoriteColor"];
    $favoritePlace = $row["FavoritePlace"];
    $nickname      = $row["Nickname"];
  }
}
else if ($update) {
  $fullName      = esc($conn, $_POST["full_name"] ?? "");
  $birthdate     = esc($conn, $_POST["birthdate"] ?? "");
  $favoriteColor = esc($conn, $_POST["favorite_color"] ?? "");
  $favoritePlace = esc($conn, $_POST["favorite_place"] ?? "");
  $nickname      = esc($conn, $_POST["nickname"] ?? "");

  $updQuery = "
    UPDATE personal_info SET
      FullName = '$fullName',
      Birthdate = '$birthdate',
      FavoriteColor = '$favoriteColor',
      FavoritePlace = '$favoritePlace',
      Nickname = '$nickname'
    WHERE UserNo = $userNo
  ";
  mysqli_query($conn, $updQuery);

  clearForm($userNo, $fullName, $birthdate, $favoriteColor, $favoritePlace, $nickname);
}
else if ($delete) {
  $delQuery = "DELETE FROM personal_info WHERE UserNo = $userNo";
  mysqli_query($conn, $delQuery);

  clearForm($userNo, $fullName, $birthdate, $favoriteColor, $favoritePlace, $nickname);
}

// Query for display
$query  = "SELECT * FROM personal_info ORDER BY UserNo";
$result = mysqli_query($conn, $query);
?>

<style>
table { border-spacing: 5px; }
table, th, td { border: 1px solid black; border-collapse: collapse; }
th, td { padding: 15px; text-align: center; }
th { background-color: lightskyblue; }
tr:nth-child(even) { background-color: whitesmoke; }
tr:nth-child(odd) { background-color: lightgray; }
</style>

<html>
<head>
  <title>Ruffin</title>
</head>

<body>
  <h2>Ruffin 3 Performance Assessment</h2>

  <h3>Current Personal Info:</h3>
  <table>
    <tr style="font-size:large;">
      <th>User #</th>
      <th>Name</th>
      <th>Date of Birth</th>
      <th>Favorite Color</th>
      <th>Favorite Place To Visit</th>
      <th>Nickname</th>
      <th></th>
      <th></th>
    </tr>

    <?php while ($row = mysqli_fetch_array($result)) : ?>
      <tr>
        <td><?php echo $row["UserNo"]; ?></td>
        <td><?php echo $row["FullName"]; ?></td>
        <td><?php echo $row["Birthdate"]; ?></td>
        <td><?php echo $row["FavoriteColor"]; ?></td>
        <td><?php echo $row["FavoritePlace"]; ?></td>
        <td><?php echo $row["Nickname"]; ?></td>

        <td>
          <form method="POST">
            <input type="submit" value="Edit" name="edit">
            <input type="hidden" value="<?php echo $row["UserNo"]; ?>" name="user_no">
          </form>
        </td>

        <td>
          <form method="POST">
            <input type="submit" value="Delete" name="delete">
            <input type="hidden" value="<?php echo $row["UserNo"]; ?>" name="user_no">
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <form method="POST">
    <input type="hidden" value="<?php echo $userNo; ?>" name="user_no">

    <h3>Name:
      <input type="text" name="full_name" value="<?php echo htmlspecialchars($fullName); ?>">
    </h3>

    <h3>Date of Birth:
      <input type="text" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>">
    </h3>

    <h3>Favorite Color:
      <input type="text" name="favorite_color" value="<?php echo htmlspecialchars($favoriteColor); ?>">
    </h3>

    <h3>Favorite Place To Visit:
      <input type="text" name="favorite_place" value="<?php echo htmlspecialchars($favoritePlace); ?>">
    </h3>

    <h3>Nickname:
      <input type="text" name="nickname" value="<?php echo htmlspecialchars($nickname); ?>">
    </h3>

    <?php if (!$edit) : ?>
      <input type="submit" value="Add" name="add">
    <?php else : ?>
      <input type="submit" value="Update" name="update">
    <?php endif; ?>
  </form>
</body>
</html>
