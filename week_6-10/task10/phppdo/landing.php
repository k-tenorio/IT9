<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Simple PDO CRUD</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 40px;
    }

    .container {
      width: 800px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    h3 {
      margin-top: 30px;
    }

    form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      margin-top: 15px;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button[name="add"] {
      background-color: #28a745;
      color: white;
    }

    button[name="update"] {
      background-color: #007bff;
      color: white;
    }

    a {
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 4px;
    }

    .edit {
      background-color: #ffc107;
      color: black;
    }

    .delete {
      background-color: #dc3545;
      color: white;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th {
      background-color: #343a40;
      color: white;
    }

    th,
    td {
      padding: 10px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    hr {
      margin: 30px 0;
    }
  </style>
</head>

<body>

  <div class="container">

    <h2>Simple PDO CRUD</h2>

    <?php
    $editUser = null;

    if (isset($_GET['edit'])) {
      $users_id = $_GET['edit'];
      $stmt = $pdo->prepare("SELECT * FROM users WHERE users_id = ?");
      $stmt->execute([$users_id]);
      $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <h3><?= $editUser ? 'Update User' : 'Add User' ?></h3>

    <form method="POST">

      <?php if (!empty($editUser)): ?>
        <input type="hidden" name="users_id" value="<?= $editUser['users_id'] ?>">
      <?php endif; ?>

      <label>Name</label>
      <input type="text" name="name" value="<?= $editUser['name'] ?? '' ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?= $editUser['email'] ?? '' ?>" required>

      <label>Product</label>
      <input type="text" name="product" value="<?= $editUser['product'] ?? '' ?>" required>

      <label>Amount</label>
      <input type="number" step="0.01" name="amount" value="<?= $editUser['amount'] ?? '' ?>" required>

      <?php if (!empty($editUser)): ?>
        <button type="submit" name="update">Update</button>
        <a href="landing.php">Cancel</a>
      <?php else: ?>
        <button type="submit" name="add">Add</button>
      <?php endif; ?>

    </form>

    <hr>

    <h3>User List</h3>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Product</th>
        <th>Amount</th>
        <th>Action</th>
      </tr>

      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user['users_id'] ?></td>
          <td><?= $user['name'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= $user['product'] ?></td>
          <td><?= $user['amount'] ?></td>
          <td>
            <a class="edit" href="?edit=<?= $user['users_id'] ?>">Edit</a>
            <a class="delete" href="?delete=<?= $user['users_id'] ?>"
              onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>

    </table>

  </div>

</body>

</html>