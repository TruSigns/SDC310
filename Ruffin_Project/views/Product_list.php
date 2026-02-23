<?php include "views/header.php"; ?>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($products)) : ?>
<tr>
    <td><?= $row['product_id']; ?></td>
    <td><?= $row['product_name']; ?></td>
    <td><?= $row['product_description']; ?></td>
    <td>$<?= $row['price']; ?></td>
    <td>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $row['product_id']; ?>">
            <input type="submit" name="delete" value="Delete">
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>

<h3>Add Product</h3>
<form method="POST">
    Name: <input type="text" name="name"><br><br>
    Description: <input type="text" name="description"><br><br>
    Price: <input type="text" name="price"><br><br>
    <input type="submit" name="add" value="Add">
</form>

<?php include "views/footer.php"; ?>

