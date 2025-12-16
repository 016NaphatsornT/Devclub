<?php
include 'db.php';
if ($_POST) {
    $stmt = $conn->prepare(
        "INSERT INTO members(f_name,L_name,email,major,year) VALUES (?,?,?,?,?)"
    );
    $stmt->bind_param(
        "ssssi",
        $_POST['f_name'],
        $_POST['L_name'],
        $_POST['email'],
        $_POST['major'],
        $_POST['year']
    );
    $stmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">

    <h3>➕ เพิ่มสมาชิกใหม่</h3>

    <form method="post">
        <input class="form-control mb-2" name="f_name" placeholder="ชื่อ" required>
        <input class="form-control mb-2" name="L_name" placeholder="นามสกุล" required>
        <input class="form-control mb-2" type="email" name="email" placeholder="อีเมล" required>
        <input class="form-control mb-2" name="major" placeholder="สาขาที่ศึกษา" required>
        <input class="form-control mb-2" type="number" name="year" placeholder="ปีการศึกษา (พ.ศ.)" required>
        <button class="btn btn-success">บันทึก</button>
        <a href="index.php" class="btn btn-secondary">กลับ</a>
    </form>

</body>

</html>