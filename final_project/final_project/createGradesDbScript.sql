-- #1  Add a statement below to DROP the database if it exists
DROP DATABASE IF EXISTS grades;

-- #2  Add a statement below to CREATE the database
CREATE DATABASE grades;

-- #3  Add a statement to USE the database
USE grades;

-- class table statement -----------------------------------------------------
CREATE TABLE IF NOT EXISTS grades.class (
  class_id INT NOT NULL AUTO_INCREMENT,
  department_code CHAR(4) NULL,
  course_number INT NULL,
  course_section CHAR(4) NULL,
  course_name VARCHAR(100) NULL,
  academic_quarter CHAR(2) NULL,
  academic_year INT NULL,
  PRIMARY KEY (class_id)
);

-- insert INFO 1335 class ------------------------------------------------
INSERT INTO grades.class (department_code, course_number, course_section, course_name, academic_quarter, academic_year) 
VALUES ('INFO', '1335', 'WW', 'Full Stack App Development', 'FA', '2023'),
('CPSC', 1234, 'AB', 'Intro to Computer Science', 'SP', 2024),
('MKTG', 5678, 'RF', 'Principles of Marketing', 'WI', 2024);

-- assignment table statement ------------------------------------------------
CREATE TABLE IF NOT EXISTS grades.assignment (
  grade_id INT NOT NULL AUTO_INCREMENT,
  task_name VARCHAR(100) NULL,
  points_earned INT NOT NULL,
  points_possible INT NOT NULL,
  class_id INT NOT NULL,
  PRIMARY KEY (grade_id),
  CONSTRAINT fk_assignment_class
    FOREIGN KEY (class_id) REFERENCES class (class_id)
);

-- insert to assignments
INSERT INTO grades.assignment (task_name, points_earned, points_possible, class_id) 
VALUES 
-- INFO 1335 (class_id = 1)
('Introduction Discussion', 10, 10, 1),
('SQL Scripting Project', 95, 100, 1),
('Midterm Exam', 88, 100, 1),

-- CPSC 1234 (class_id = 2)
('Python Lab 1', 20, 20, 2),
('Python Lab 2', 18, 20, 2), 
('Midterm Exam', 88, 100, 2),

-- MKTG 5678 (class_id = 3)
('Case Study 1', 58, 50, 3),
('Group Presentation', 90, 100, 3), 
('Final Paper', 89, 100, 3);


-- grant priviledges for mgs_user --------------------
GRANT DELETE, INSERT, SELECT, UPDATE ON grades.* TO mgs_user@localhost;