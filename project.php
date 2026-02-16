<?php
// Week 3: Accessing the Database using PHP Code
// Displays data from sdc310l_project: products and users

$hostname = "127.0.0.1";
$username = "ecpi_user";    
$password = "Password1";     
$dbname   = "sdc310l_project";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

$productsResult = mysqli_query($conn, "SELECT product_id, product_name, product_description, price, created_at FROM products ORDER BY product_id");
$usersResult    = mysqli_query($conn, "SELECT user_id, first_name, last_name, email, created_at FROM users ORDER BY user_id");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Your Name Week 3 Database Support</title>
  <style>
    body { font-family: Arial, sans-serif; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
    th, td { border: 1px solid #000; padding: 10px; text-align: left; }
    th { background-color: #cfe8ff; }
    h2 { margin-top: 30px; }
  </style>
</head>

<body>
  <h1>Your Name Week 3 Database Support</h1>

  <h2>Products</h2>
  <table>
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Created At</th>
    </tr>

    <?php if ($productsResult && mysqli_num_rows($productsResult) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($productsResult)): ?>
        <tr>
          <td><?php echo $row["product_id"]; ?></td>
          <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
          <td><?php echo htmlspecialchars($row["product_description"] ?? ""); ?></td>
          <td><?php echo number_format((float)$row["price"], 2); ?></td>
          <td><?php echo $row["created_at"]; ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No products found.</td></tr>
    <?php endif; ?>
  </table>

  <h2>Users</h2>
  <table>
    <tr>
      <th>User ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Created At</th>
    </tr>

    <?php if ($usersResult && mysqli_num_rows($usersResult) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
        <tr>
          <td><?php echo $row["user_id"]; ?></td>
          <td><?php echo htmlspecialchars($row["first_name"]); ?></td>
          <td><?php echo htmlspecialchars($row["last_name"]); ?></td>
          <td><?php echo htmlspecialchars($row["email"]); ?></td>
          <td><?php echo $row["created_at"]; ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No users found.</td></tr>
    <?php endif; ?>
  </table>

</body>
</html>

<?php mysqli_close($conn); ?>
