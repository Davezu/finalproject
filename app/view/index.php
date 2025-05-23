<?php
$pdo = require_once '../model/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['job_id']) && !empty($_POST['job_id'])) {
        //updateCurrent info sa table
        $stmt = $pdo->prepare("UPDATE js_tbl SET `job-info` = :jobInfo, description = :description, location = :location, salary = :salary WHERE job_id = :jobId");
        
        $stmt->execute([
            ':jobId' => $_POST['job_id'],
            ':jobInfo' => $_POST['job-info'],
            ':description' => $_POST['description'],
            ':location' => $_POST['location'],
            ':salary' => $_POST['salary']
        ]);
        header('Location: index.php');
        exit;
    } else {
        //create
        $stmt = $pdo->prepare("INSERT INTO js_tbl (`job-info`, description, location, salary) VALUES (:jobInfo, :description, :location, :salary)"); 
        $stmt->execute([
            ':jobInfo' => $_POST['job-info'],
            ':description' => $_POST['description'],
            ':location' => $_POST['location'],
            ':salary' => $_POST['salary']
        ]);
        header('Location: index.php');
        exit;
    }
}

//delet
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM js_tbl WHERE job_id = :jobId");
    $stmt->execute([':jobId' => $_GET['delete']
]);
    header('Location: index.php');
    exit;
}

//editFunc
$editJob = null;
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM js_tbl WHERE job_id = :id");
    $stmt->bindParam(':id', $_GET['edit'], PDO::PARAM_INT);
    $stmt->execute();
    
    $editJob = $stmt->fetch();
}

//getalljobs
$jobs = [];
$stmt = $pdo->query("SELECT * FROM js_tbl ORDER BY job_id DESC");
if ($stmt->rowCount() > 0) {
    $jobs = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="nav-container">
        <div class="logo">
            <a href="/">
                <svg viewBox="0 0 248 66" height="40" class="o3fpgs4z _1xd9sxs9 gxyy3e0"><circle cy="32.98" cx="32.98" r="30" fill="#fff" class="_1xd9sxse"></circle><mask id="jobStreetCutArrowOutOfCircle"><circle fill="white" cx="32.98" cy="32.98" r="32.98"></circle><path fill="black" d="M33.76 12.58c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M40.18 19.51c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 19.51c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.93-2.06-2.06M47 26.46c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 27.87 47 26.46M40.18 26.44c0-1.26 1.02-2.27 2.27-2.27s2.28 1.02 2.28 2.27-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 26.44c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 26.44c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 26.44c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.55-1.54 1.55-1.54-.69-1.54-1.55M17.66 26.44c0-.71.58-1.29 1.29-1.29s1.29.58 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 26.44c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 26.44c0-.43.34-.77.77-.77s.77.35.77.77-.35.77-.77.77-.77-.35-.77-.77M6.33 26.44c0-.29.23-.51.52-.51s.51.23.51.51-.23.52-.51.52-.52-.23-.52-.52M47 33.39c0-1.41 1.14-2.55 2.55-2.55s2.55 1.15 2.55 2.55-1.14 2.55-2.55 2.55S47 34.8 47 33.39M40.18 33.37c0-1.26 1.02-2.27 2.27-2.27s2.28 1.01 2.28 2.27-1.02 2.28-2.28 2.28-2.27-1.02-2.27-2.28M33.76 33.37c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 33.37c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 33.37c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.55M17.66 33.37c0-.71.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 33.37c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 33.37c0-.43.34-.77.77-.77s.77.35.77.77-.35.77-.77.77-.77-.35-.77-.77M6.33 33.37c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M54 33.44c0-1.55 1.26-2.8 2.8-2.8s2.8 1.25 2.8 2.8-1.25 2.79-2.8 2.79-2.8-1.25-2.8-2.79M47 40.32c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 41.73 47 40.32M40.18 40.3c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 40.3c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 40.3c0-1 .81-1.81 1.8-1.81s1.81.81 1.81 1.81-.81 1.8-1.81 1.8-1.8-.8-1.8-1.8M22.53 40.3c0-.86.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.54M17.66 40.3c0-.72.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 40.3c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 40.3c0-.43.34-.78.77-.78s.77.35.77.78-.35.77-.77.77-.77-.35-.77-.77M6.33 40.3c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M40.18 47.23c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 47.23c0-1.14.92-2.07 2.06-2.07s2.06.93 2.06 2.07-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M33.76 54.16c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06"></path></mask><circle fill="#0d3880" class="_1xd9sxsd" cx="32.98" cy="32.98" r="32.98" mask="url(#jobStreetCutArrowOutOfCircle)"></circle><path fill="#000" class="_1xd9sxsf" d="M82.79 17.04h-5.98V12.2h5.98v4.84Zm0 29.92c0 1.86-.55 3.41-1.64 4.66-1.25 1.43-3.01 2.15-5.3 2.15h-3.38v-5.02h2.26c1.39 0 2.08-.72 2.08-2.15V21.07h5.98v25.9ZM100.97 32.94c0-2.92-.45-4.84-1.36-5.76-.69-.7-1.61-1.05-2.76-1.05s-2.02.35-2.71 1.05c-.9.91-1.36 2.83-1.36 5.76s.45 4.89 1.36 5.8c.69.7 1.6 1.05 2.71 1.05s2.06-.35 2.76-1.05c.9-.91 1.36-2.85 1.36-5.8m5.98 0c0 2.28-.18 4.1-.55 5.44-.4 1.49-1.11 2.77-2.15 3.84-1.86 1.95-4.32 2.92-7.4 2.92s-5.5-.97-7.35-2.92c-1.04-1.07-1.75-2.34-2.15-3.84-.37-1.34-.55-3.15-.55-5.44 0-4.26.91-7.35 2.74-9.27s4.26-2.88 7.31-2.88 5.53.96 7.35 2.88c1.83 1.92 2.74 5.01 2.74 9.27M124.99 32.94c0-2.1-.17-3.61-.5-4.52-.6-1.52-1.76-2.28-3.48-2.28s-2.88.76-3.48 2.28c-.33.91-.5 2.42-.5 4.52s.17 3.61.5 4.52c.6 1.55 1.76 2.33 3.48 2.33s2.87-.78 3.48-2.33c.33-.91.5-2.42.5-4.52m5.98 0c0 2.44-.11 4.26-.32 5.48-.34 1.98-1.04 3.5-2.1 4.57-1.43 1.43-3.37 2.15-5.8 2.15s-4.42-.84-5.94-2.51v2.24h-5.76V12.34h5.98v10.83c1.43-1.58 3.34-2.37 5.74-2.37s4.36.72 5.78 2.15c1.06 1.07 1.76 2.59 2.09 4.57.21 1.22.32 3.03.32 5.44M153.04 37.37c0 2.53-.98 4.48-2.92 5.85-1.83 1.28-4.22 1.92-7.17 1.92-2.22 0-4.04-.2-5.44-.59-1.77-.52-3.33-1.46-4.71-2.83l3.88-3.88c1.49 1.49 3.61 2.24 6.35 2.24s4.2-.82 4.2-2.47c0-1.31-.84-2.04-2.51-2.19l-3.75-.37c-4.63-.46-6.94-2.68-6.94-6.67 0-2.37.93-4.26 2.79-5.66 1.7-1.28 3.84-1.92 6.39-1.92 4.08 0 7.11.93 9.09 2.79l-3.65 3.7c-1.19-1.07-3.03-1.6-5.53-1.6-2.25 0-3.38.76-3.38 2.28 0 1.22.82 1.9 2.47 2.06l3.75.37c4.72.46 7.08 2.79 7.08 6.99M167.16 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02ZM188.35 23.02l-4.48 4.52c-.94-.94-1.99-1.42-3.15-1.42-1.01 0-1.87.35-2.6 1.05-.82.82-1.23 1.93-1.23 3.33v14.34h-5.94v-23.8h5.8v2.28c1.43-1.7 3.43-2.56 5.98-2.56 2.25 0 4.13.75 5.62 2.24M203.88 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84.93.97 2.2 1.46 3.81 1.46 2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM227.36 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84s2.2 1.46 3.81 1.46c2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM247.87 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02Z"></path>
                </svg>
            </a>
        </div>
        <div class="nav-links">
            <a href="">Job Search</a>
            <a href="/profile">Home</a>
            <a href="/about.php">About</a>
            <a href="/faq.php">FAQ</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="user">
            <div class="username">
                <a href="" class="user-link text-dark">Dave</a>
                <a href="/employer" class="user-link">Employer</a>
            </div>
        </div>
    </nav>
    <div class="promo-bar">
        <span class="gift-icon">🎁</span> Get 50% off. Use the code <strong>TEST</strong> at checkout.
    </div>
    <div class="container">
        <div class="row welcome-section">
            <div class="col-md-6 welcome-text">
                <h4>Welcome to JobStreet</h4>
                <p>You are in the right place to find your next hire. Get started by<br>
                creating your first job ad.</p>
               <a href="/search.php" class="btn btn-pink"><b>Search</b></a>
            </div>
            <div class="col-md-6 job-creation-container">
                <div class="pink-curve-container">
                    <svg width="288" height="144" viewBox="0 0 288 144" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M288 3.43437e-06L192 2.28958e-06C192 26.5097 170.51 48 144 48C117.49 48 95.9999 26.5097 95.9999 1.14479e-06L1.71718e-06 0C7.68809e-07 79.529 64.4709 144 144 144C223.529 144 288 79.529 288 3.43437e-06Z" fill="#E60278"></path>
                    </svg>
                </div>
                <div class="job-creation-image">
                    <img src="https://ph.employer.seek.com/static/hirer-dashboard/343992c4cb08b25a3c4a.png" alt="JobStreet">
                </div>
            </div>
        </div>
        <div class="job-ads-header">
            <h2>My recent job ads</h2>
                <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Job</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $editJob ? 'Edit Job' : 'Add Job'; ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form id="job-form" method="POST" action="index.php">
                                    <div class="mb-3">
                                        <label for="job-title" class="col-form-label">Job Title:</label>
                                        <input type="text" class="form-control" id="job-title" name="job-info" required value="<?php echo $editJob ? htmlspecialchars($editJob['job-info']) : ''; ?>">
                                        <input type="hidden" id="job-id" name="job_id" value="<?php echo $editJob ? htmlspecialchars($editJob['job_id']) : ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="job-description" class="col-form-label">Job Description:</label>
                                        <textarea class="form-control" id="job-description" name="description" rows="8" required><?php echo $editJob ? htmlspecialchars($editJob['description']) : ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="job-location" class="col-form-label">Job Location:</label>
                                        <input type="text" class="form-control" id="job-location" name="location" required value="<?php echo $editJob ? htmlspecialchars($editJob['location']) : ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="job-salary" class="col-form-label">Job Salary:</label>
                                        <input type="number" class="form-control" id="job-salary" name="salary" required value="<?php echo $editJob ? htmlspecialchars($editJob['salary']) : ''; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"><?php echo $editJob ? 'Update Job' : 'Create job ad'; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="job-ads-table-container">
            <table class="job-ads-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job</th>
                        <th>Job Description</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Job actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jobs)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No jobs found</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td>
                                <span class="status-badge draft"><?php echo htmlspecialchars($job['job_id']); ?></span>
                            </td>
                            <td>
                                <div class="job-info">
                                    <div class="job-title"><?php echo htmlspecialchars($job['job-info']); ?></div>
                                    <div class="job-location"><?php echo htmlspecialchars($job['location']); ?></div>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($job['description']); ?></td>
                            <td><?php echo htmlspecialchars($job['location']); ?></td>
                            <td><?php echo htmlspecialchars($job['salary']); ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $job['job_id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="index.php?delete=<?php echo $job['job_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($editJob): ?>
            const myModal = new bootstrap.Modal(document.querySelector('#exampleModal'));
            myModal.show();
            <?php endif; ?>
        });
    </script>
</body>
</html>