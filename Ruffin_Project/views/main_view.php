<?php include "views/header.php"; ?>

<h2>Products</h2>
<table>
<tr>
<th>Product ID</th>
<th>Name</th>
<th>Description</th>
<th>Price</th>
<th>Created At</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($productsResult)) : ?>
<tr>
<td><?= $row["product_id"]; ?></td>
<td><?= htmlspecialchars($row["product_name"]); ?></td>
<td><?= htmlspecialchars($row["product_description"]); ?></td>
<td><?= number_format($row["price"], 2); ?></td>
<td><?= $row["created_at"]; ?></td>
</tr>
<?php endwhile; ?>
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

<?php while ($row = mysqli_fetch_assoc($usersResult)) : ?>
<tr>
<td><?= $row["user_id"]; ?></td>
<td><?= htmlspecialchars($row["first_name"]); ?></td>
<td><?= htmlspecialchars($row["last_name"]); ?></td>
<td><?= htmlspecialchars($row["email"]); ?></td>
<td><?= $row["created_at"]; ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include "views/footer.php"; ?>