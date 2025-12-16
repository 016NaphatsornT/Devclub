<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>DevClub Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">

    <h3 class="mb-3">📋 รายชื่อสมาชิก DevClub</h3>

    <a href="add.php" class="btn btn-primary mb-3">➕ เพิ่มสมาชิกใหม่</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <th>สาขา</th>
                    <th>ปีการศึกษา</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $result = $conn->query("SELECT * FROM members");
                while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['f_name'] ?></td>
                        <td><?= $row['L_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['major'] ?></td>
                        <td><?= $row['year'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </div>

</body>

</html>