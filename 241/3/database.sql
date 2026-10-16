CREATE DATABASE IF NOT EXISTS electricity_bill;
USE electricity_bill;

CREATE TABLE IF NOT EXISTS bill_info (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    location VARCHAR(100),
    area VARCHAR(100),
    rate_0_75 FLOAT,
    rate_76_200 FLOAT,
    rate_201_above FLOAT
);

INSERT INTO bill_info (id, location, area, rate_0_75, rate_76_200, rate_201_above) VALUES
(1, 'Dhaka', 'Urban', 4.19, 5.72, 6.00),
(2, 'Dhaka', 'Rural', 3.19, 4.72, 5.00),
(3, 'Chittagong', 'Urban', 3.50, 4.80, 5.23),
(4, 'Chittagong', 'Rural', 2.50, 3.80, 4.23)
ON DUPLICATE KEY UPDATE rate_0_75=VALUES(rate_0_75), rate_76_200=VALUES(rate_76_200), rate_201_above=VALUES(rate_201_above);
