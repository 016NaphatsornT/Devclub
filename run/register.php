<?php
require 'db.php';

/* ดึงข้อมูลประเภทการแข่งขัน */
$category_sql = "SELECT category_id, name FROM race_category";
$category_result = $conn->query($category_sql);

/* ดึงข้อมูลการจัดส่ง */
$shipping_sql = "SELECT shipping_id, name FROM shipping_option";
$shipping_result = $conn->query($shipping_sql);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ฟอร์มลงทะเบียนการแข่งขันวิ่ง</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background: #f2f2f2;
        }

        .container {
            width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background: green;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>ฟอร์มลงทะเบียนการแข่งขันวิ่ง</h2>

        <form action="save_register.php" method="post">

            <!-- ข้อมูลผู้สมัคร -->
            <label>ชื่อ</label>
            <input type="text" name="first_name" required>

            <label>นามสกุล</label>
            <input type="text" name="last_name" required>

            <label>วันเกิด</label>
            <input type="date" name="birth_date" required>

            <label>เพศ</label>
            <select name="gender" required>
                <option value="">-- เลือกเพศ --</option>
                <option value="Male">ชาย</option>
                <option value="Female">หญิง</option>
            </select>

            <label>เบอร์โทรศัพท์</label>
            <input type="text" name="phone" required>

            <label>Email</label>
            <input type="email" name="email">

            <label>ที่อยู่</label>
            <textarea name="address"></textarea>

            <label>
                <input type="checkbox" name="is_student" value="1">
                เป็นนักเรียน / นักศึกษา
            </label>

            <hr>

            <!-- ข้อมูลการแข่งขัน -->
            <label>ประเภทการแข่งขัน</label>
            <select name="category_id" required>
                <option value="">-- เลือกประเภทการแข่งขัน --</option>
                <?php while ($row = $category_result->fetch_assoc()) { ?>
                    <option value="<?= $row['category_id']; ?>">
                        <?= $row['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label>ขนาดเสื้อ</label>
            <select name="shirt_size" required>
                <option value="">-- เลือกขนาดเสื้อ --</option>
                <option>XS</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
                <option>XXL</option>
            </select>

            <label>การจัดส่ง</label>
            <select name="shipping_id" required>
                <option value="">-- เลือกการจัดส่ง --</option>
                <?php while ($row = $shipping_result->fetch_assoc()) { ?>
                    <option value="<?= $row['shipping_id']; ?>">
                        <?= $row['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">ลงทะเบียน</button>
        </form>
    </div>

</body>

</html>