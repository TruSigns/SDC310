<?php
$name = "";
$dob = "";
$color = "";
$place = "";
$nickname = "";

$submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;

    $name = trim($_POST["name"] ?? "");
    $dob = trim($_POST["dob"] ?? "");
    $color = trim($_POST["color"] ?? "");
    $place = trim($_POST["place"] ?? "");
    $nickname = trim($_POST["nickname"] ?? "");

    var_dump($name);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ruffin Wk 2 Performance Assessment</title>
    <style>
        body { font-family: Arial; }
        label { display: block; margin-top: 10px; }
        .output { margin-top: 20px; }
    </style>
</head>
<body>

<h1>Ruffin Wk 2 Performance Assessment</h1>

<form method="POST">
    <label>Name:
        <input type="text" name="name">
    </label>

    <label>Date of Birth:
        <input type="text" name="dob">
    </label>

    <label>Favorite Color:
        <input type="text" name="color">
    </label>

    <label>Favorite Place To Visit:
        <input type="text" name="place">
    </label>

    <label>Nickname:
        <input type="text" name="nickname">
    </label>

    <br><br>
    <input type="submit" value="Submit">
</form>

<?php if ($submitted): ?>
<div class="output">

<?php
function showField($label, $value) {
    if ($value !== "") {
        echo "<p>$label: $value</p>";
    } else {
        echo "<p>You didn't enter your $label.</p>";
    }
}

showField("Name", $name);
showField("Date of Birth", $dob);
showField("Favorite Color", $color);
showField("Favorite Place To Visit", $place);
showField("Nickname", $nickname);
?>

</div>
<?php endif; ?>

</body>
</html>