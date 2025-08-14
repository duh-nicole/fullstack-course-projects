-- #1  Add a statement below to DROP the database if it exists
DROP DATABASE IF EXISTS grades;

-- #2  Add a statement below to CREATE the database
CREATE DATABASE grades;

-- #3  Add a statement to USE the database
USE grades;


-- Create the class table with a primary key
CREATE TABLE class (
  class_id INT NOT NULL AUTO_INCREMENT,
  department_code CHAR(4) NULL,
  course_number INT NULL,
  course_section CHAR(4) NULL,
  course_name VARCHAR(100) NULL,
  academic_quarter CHAR(2) NULL,
  academic_year INT NULL,
  PRIMARY KEY (class_id)
);

-- Create the assignment table with a foreign key to class_id
CREATE TABLE assignment (
  grade_id INT NOT NULL AUTO_INCREMENT,
  task_name VARCHAR(100) NULL,
  points_earned INT NOT NULL,
  points_possible INT NOT NULL,
  class_id INT NOT NULL,
  PRIMARY KEY (grade_id),
  CONSTRAINT fk_assignment_class
    FOREIGN KEY (class_id) REFERENCES class (class_id)
);




-- grant priviledges for mgs_user --------------------
GRANT DELETE, INSERT, SELECT, UPDATE ON grades.* TO mgs_user@localhost;
