CREATE DATABASE IF NOT EXISTS campus_library;
USE campus_library;

CREATE TABLE IF NOT EXISTS book_loans (
    LoanID INT PRIMARY KEY,
    StudentName VARCHAR(100),
    BookTitle VARCHAR(100),
    DaysOverdue INT,
    PenaltyFee DECIMAL(10, 2),
    Status VARCHAR(50)
);

INSERT INTO book_loans (LoanID, StudentName, BookTitle, DaysOverdue, PenaltyFee, Status) VALUES
(101, 'Abdul', 'Data Structures', 0, 0.00, 'Returned'),
(102, 'Jabbar', 'Operating Systems', 12, 24.00, 'Overdue'),
(103, 'Barkat', 'Discrete Math', 5, 10.00, 'Overdue'),
(104, 'Rahim', 'Linear Algebra', 2, 4.00, 'Overdue'),
(105, 'Karim', 'Data Structures', 15, 30.00, 'Lost'),
(106, 'Fahim', 'Operating Systems', 0, 0.00, 'Returned')
ON DUPLICATE KEY UPDATE PenaltyFee=VALUES(PenaltyFee), Status=VALUES(Status);
