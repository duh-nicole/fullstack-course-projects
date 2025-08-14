
USE grades; 

-- insert to class ------------------------------------------------
INSERT INTO grades.class (department_code, course_number, course_section, course_name, academic_quarter, academic_year) 
VALUES 

('INFO', '1335', 'WW', 'Full Stack App Development', 'FA', '2023'),
('CPSC', 1234, 'AB', 'Intro to Computer Science', 'SP', 2024),
('MKTG', 5678, 'RF', 'Principles of Marketing', 'WI', 2024);

-- insert to assignments -------------------------------------
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
