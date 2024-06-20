<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAREER ME</title>
  <link rel="stylesheet" type="text/css" href="src/css/theme.css">
  <link rel="stylesheet" type="text/css" href="src/css/main.css">
  <link rel="stylesheet" type="text/css" href="src/css/home.css">
  <link rel="stylesheet" type="text/css" href="src/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="src/css/vacancy.css">
</head>

<body>

  <nav class="navbar-container">
    <?php require_once 'common/navbar.php'; ?>
  </nav>
  <br>
  
    <header>
        <h1>Job Recruitment</h1>
    </header>

    <form id="job-search" method="post" action="vacancy.php">
        <label for="search">Search Jobs:</label>
        <input type="text" id="search" name="query" placeholder="Enter keywords">
        <button type="submit">Search</button>
    </form>

    <div id="job-listings">
        <div class="box"></div>
        <!-- job listings will be displayed based on search results-->
    </div>
    <?php
    require 'utils/db-conn.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $searchQuery = isset($_POST['query']) ? $_POST['query'] : '';

        $sql = "SELECT * FROM cvs WHERE user_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['user_id']);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cvs = $result->fetch_all(MYSQLI_ASSOC);
        }



        $sql = "SELECT * FROM jobs WHERE title LIKE '%$searchQuery%'";
        $result = $conn->query($sql);


        if ($result !== false && $result->num_rows > 0) {
            echo "<h1>Jobs you may be interested in</h1>";
            echo "<table border='1'>
                    <tr>
                        <th>job_id</th>
                        <th>job_title</th>
                        <th>company_name</th>
                        <th>location</th>
                        <th>job_category</th>
                        <th>posted_date</th>
                        <th>deadline</th>
                        <th>salary</th>
                        <th>employment_type</th>
                        <th>description</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM employers WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $row['employer_id']);
                $stmt->execute();

                $employer = $stmt->get_result()->fetch_assoc();

                echo "<tr>
                            <td>{$row['job_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$employer['company_name']}</td>
                            <td>{$employer['address']}</td>
                            <td>{$row['job_category']}</td>
                            <td>{$row['posted_date']}</td>
                            <td>{$row['deadline']}</td>
                            <td>{$row['salary']}</td>
                            <td>{$row['employment_type']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <form method='post' action='apply.php' enctype='multipart/form-data'>
                                    <input type='hidden' name='job_id' value='{$row['job_id']}'>
                                    <input type='hidden' name='application_date' value='" . date("Y-m-d H:i:s") . "'>
                                    <select name='cv_id' id='cv_id' required>
                                        <option value=''>Select CV</option>";
                foreach ($cvs as $cv) {
                    echo "<option value='" . $cv['cv_id'] . "'>" . $cv['name'] . "</option>";
                }
                echo "</select>
                <button value='submit' class='button green' name='approve' type='submit'><span class='material-symbols-outlined'>
                check</span><span class='text'>Save</span>
        </button>
                                </form>
                            </td>
                        </tr>";
            }
            echo "</table>";
        } else {
            echo "No jobs found";
        }
    }

    $conn->close();
    ?>
    </div>

</body>

</html>