<?php
// require database connection
require_once('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h1>Student Grades Dashboard</h1>

        <?php
        // SQL to select all classes
        $sql_classes = "SELECT * FROM class ORDER BY class_id";
        $result_classes = mysqli_query($conn, $sql_classes);

        // Check if there are classes to display
        if (mysqli_num_rows($result_classes) > 0) {
            // Loop through each class record
            while ($class = mysqli_fetch_assoc($result_classes)) {
                $class_id = $class['class_id'];
                $class_name = $class['course_name'];
                $dept_code = $class['department_code'];
                $course_num = $class['course_number'];

                echo "<h2>$dept_code $course_num - $class_name</h2>";

                // SQL to get assignments for the current class
                $sql_assignments = "SELECT * FROM assignment WHERE class_id = $class_id";
                $result_assignments = mysqli_query($conn, $sql_assignments);

                // Initialize variables for grade calculation
                $total_points_earned = 0;
                $total_points_possible = 0;

                // Check if there are assignments for this class
                if (mysqli_num_rows($result_assignments) > 0) {
                    echo "<table>";
                    echo "<thead><tr><th>Assignment</th><th>Points Earned</th><th>Points Possible</th></tr></thead>";
                    echo "<tbody>";

                    // Loop through each assignment record
                    while ($assignment = mysqli_fetch_assoc($result_assignments)) {
                        echo "<tr>";
                        echo "<td>" . $assignment['task_name'] . "</td>";
                        echo "<td>" . $assignment['points_earned'] . "</td>";
                        echo "<td>" . $assignment['points_possible'] . "</td>";
                        echo "</tr>";

                        // Accumulate points for the overall grade
                        $total_points_earned += $assignment['points_earned'];
                        $total_points_possible += $assignment['points_possible'];
                    }

                    // Calculate and display the overall grade
                    $overall_grade = ($total_points_possible > 0)
                        ? round(($total_points_earned / $total_points_possible) * 100, 2)
                        : 0;

                    echo "<tr class='grade-row'>";
                    echo "<td>Overall Grade</td>";
                    echo "<td></td>"; // Empty cell for alignment
                    echo "<td class='grade-percentage'>$overall_grade%</td>";
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No assignments found for this class.</p>";
                }
            }
        } else {
            echo "<p>No classes found in the database.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

