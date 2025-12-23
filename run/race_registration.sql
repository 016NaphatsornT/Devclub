-- ================================
-- Database: race_registration
-- ================================
CREATE DATABASE IF NOT EXISTS race_registration
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE race_registration;

-- ================================
-- Table: race_category
-- ================================
CREATE TABLE race_category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    distance_km FLOAT NOT NULL,
    start_time TIME NOT NULL,
    time_limit TIME,
    giveaway_type ENUM('Vest','Towel')
);

-- ================================
-- Table: age_group
-- ================================
CREATE TABLE age_group (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    gender ENUM('Male','Female'),
    min_age INT,
    max_age INT,
    bib VARCHAR(20),
    CONSTRAINT fk_agegroup_category
        FOREIGN KEY (category_id)
        REFERENCES race_category(category_id)
);

-- ================================
-- Table: price_rate
-- ================================
CREATE TABLE price_rate (
    price_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    age_group ENUM('Student','Senior','Adult'),
    amount FLOAT NOT NULL,
    CONSTRAINT fk_price_category
        FOREIGN KEY (category_id)
        REFERENCES race_category(category_id)
);

-- ================================
-- Table: shipping_option
-- ================================
CREATE TABLE shipping_option (
    shipping_id INT AUTO_INCREMENT PRIMARY KEY,
    name ENUM('EMS','Pickup'),
    cost FLOAT,
    detail VARCHAR(255)
);

-- ================================
-- Table: runner
-- ================================
CREATE TABLE runner (
    runner_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    birth_date DATE,
    gender ENUM('Male','Female'),
    citizen_id VARCHAR(20),
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    is_student BOOLEAN
);

-- ================================
-- Table: registration
-- ================================
CREATE TABLE registration (
    reg_id INT AUTO_INCREMENT PRIMARY KEY,
    runner_id INT NOT NULL,
    category_id INT NOT NULL,
    price_id INT NOT NULL,
    shipping_id INT NOT NULL,
    reg_date DATE,
    shirt_size ENUM('XS','S','M','L','XL','XXL'),
    bib_number VARCHAR(20),
    status ENUM('Pending','Paid','Cancelled'),

    CONSTRAINT fk_reg_runner
        FOREIGN KEY (runner_id)
        REFERENCES runner(runner_id),

    CONSTRAINT fk_reg_category
        FOREIGN KEY (category_id)
        REFERENCES race_category(category_id),

    CONSTRAINT fk_reg_price
        FOREIGN KEY (price_id)
        REFERENCES price_rate(price_id),

    CONSTRAINT fk_reg_shipping
        FOREIGN KEY (shipping_id)
        REFERENCES shipping_option(shipping_id)
);

-- ================================
-- Table: payment
-- ================================
CREATE TABLE payment (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    reg_id INT NOT NULL,
    total_amount FLOAT NOT NULL,
    payment_time DATETIME,
    payment_method ENUM('Transfer','Credit Card'),
    status ENUM('Success','Failed'),

    CONSTRAINT fk_payment_registration
        FOREIGN KEY (reg_id)
        REFERENCES registration(reg_id)
);
