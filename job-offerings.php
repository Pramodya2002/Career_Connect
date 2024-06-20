<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Offerings</title>
    <link rel="stylesheet" href="./src/css/job-offerings.css">
</head>

<body>
    <h1>Job Offerings</h1>
    <div class="all-forms">
        <!-- Search Applicants Form -->
        <form action="search_applicants.php" method="POST" class="search_applicants">
            <label for="searchKeyword">Search Applicants:</label>
            <input type="text" id="searchKeyword" name="searchKeyword" placeholder="Enter name or email" required>
            <button type="submit">Search</button>
        </form>

        <!-- Offer Jobs Form -->
        <form action="offer_jobs.php" method="POST" class="offer_jobs">
            <label for="jobTitle">Job Title:</label>
            <input type="text" id="jobTitle" name="jobTitle" required>

            <label for="jobDescription">Job Description:</label>
            <textarea id="jobDescription" name="jobDescription" required></textarea>

            <label for="requirements">Requirements:</label>
            <input type="text" id="requirements" name="requirements" required>

            <label for="salary">Salary:</label>
            <input type="text" id="salary" name="salary" required>

            <button type="submit">Offer Job</button>
        </form>

        <!-- View Status Form -->
        <form action="view_status.php" method="POST" class="view_status">
            <label for="jobId">View Status for Job ID:</label>
            <input type="text" id="jobId" name="jobId" placeholder="Enter Job ID" required>
            <button type="submit">View Status</button>
        </form>

        <!-- Cancel Offering Form -->
        <form action="cancel_offering.php" method="POST" class="cancel_offering">
            <label for="cancelJobId">Cancel Offering for Job ID:</label>
            <input type="text" id="cancelJobId" name="cancelJobId" placeholder="Enter Job ID" required>
            <button type="submit">Cancel Offering</button>
        </form>
 
    </div>
    
</body>

</html>