<?php
include 'db.php';
$id = $_GET['id'];

if ($_POST) {
    $stmt = $conn->prepare(
        "UPDATE members SET f_name=?,L_name=?, email=?, major=?, year=? WHERE id=?"
    );
    $stmt->bind_param(
        "ssssi",
        $_POST['f_name'],
        $_POST['L_name'],
        $_POST['email'],
        $_POST['major'],
        $_POST['year'],
        $id
    );
    $stmt->execute();
    header("Location: index.php");
}

$data = $conn->query("SELECT * FROM members WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">

    <h3>✏️ แก้ไขสมาชิก</h3>

    <form method="post">
        <input class="form-control mb-2" name="f_name" value="<?= $data['f_name'] ?>" required>
        <input class="form-control mb-2" name="L_name" value="<?= $data['L_name'] ?>" required>
        <input class="form-control mb-2" type="email" name="email" value="<?= $data['email'] ?>" required>
        <input class="form-control mb-2" name="major" value="<?= $data['major'] ?>" required>
        <input class="form-control mb-2" type="number" name="year" value="<?= $data['year'] ?>" required>
        <button class="btn btn-warning">อัปเดต</button>
        <a href="index.php" class="btn btn-secondary">กลับ</a>
    </form>

</body>

</html>