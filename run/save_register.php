<?php
require 'db.php';

/* -----------------------------
   รับค่าจากฟอร์ม
------------------------------*/
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$is_student = isset($_POST['is_student']) ? 1 : 0;

$category_id = $_POST['category_id'];
$shirt_size = $_POST['shirt_size'];
$shipping_id = $_POST['shipping_id'];
$reg_date = date("Y-m-d");

/* -----------------------------
   1) บันทึกข้อมูลผู้สมัคร (runner)
------------------------------*/
$stmt = $conn->prepare("
    INSERT INTO runner
    (first_name, last_name, birth_date, gender, phone, email, address, is_student)
    VALUES (?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "sssssssi",
    $first_name,
    $last_name,
    $birth_date,
    $gender,
    $phone,
    $email,
    $address,
    $is_student
);

$stmt->execute();
$runner_id = $stmt->insert_id;
$stmt->close();

/* -----------------------------
   2) เลือกราคา (price_rate)
   ตัวอย่าง: ถ้าเป็นนักเรียน ใช้ Student
------------------------------*/
$group = $is_student ? "Student" : "Adult";

$stmt = $conn->prepare("
    SELECT price_id 
    FROM price_rate 
    WHERE category_id = ? AND age_group = ?
");
$stmt->bind_param("is", $category_id, $group);
$stmt->execute();
$stmt->bind_result($price_id);
$stmt->fetch();
$stmt->close();

/* -----------------------------
   3) บันทึกการสมัคร (registration)
------------------------------*/
$status = "Pending";

$stmt = $conn->prepare("
    INSERT INTO registration
    (runner_id, category_id, price_id, shipping_id, reg_date, shirt_size, status)
    VALUES (?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "iiiisss",
    $runner_id,
    $category_id,
    $price_id,
    $shipping_id,
    $reg_date,
    $shirt_size,
    $status
);

$stmt->execute();
$stmt->close();

/* -----------------------------
   แสดงผลลัพธ์
------------------------------*/
echo "<h2>ลงทะเบียนสำเร็จ 🎉</h2>";
echo "<p>ขอบคุณสำหรับการสมัครเข้าร่วมการแข่งขัน</p>";
echo "<a href='register.php'>กลับไปหน้าฟอร์ม</a>";

$conn->close();
?>