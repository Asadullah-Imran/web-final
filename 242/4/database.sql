CREATE DATABASE IF NOT EXISTS retail_company;
USE retail_company;

CREATE TABLE IF NOT EXISTS sales (
    sale_id INT PRIMARY KEY,
    product_id INT,
    quantity_sold INT,
    sale_date DATE,
    total_price DECIMAL(10, 2)
);

INSERT INTO sales (sale_id, product_id, quantity_sold, sale_date, total_price) VALUES
(1, 107, 5, '2024-01-01', 2500.00),
(2, 103, 3, '2024-01-02', 900.00),
(3, 103, 2, '2024-01-02', 60.00),
(4, 107, 4, '2024-01-03', 80.00),
(5, 107, 6, '2024-01-03', 90.00)
ON DUPLICATE KEY UPDATE quantity_sold=VALUES(quantity_sold), total_price=VALUES(total_price);
