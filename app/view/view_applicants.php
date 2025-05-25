<?php
session_start();
$pdo = require_once '../model/database.php';


if (!isset($_SESSION['username'])) {
    header('Location: auth/login.php');
    exit;
}


$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;


if ($job_id > 0) {
    $stmt = $pdo->prepare("
        SELECT a.*, j.job_info 
        FROM job_applications a
        LEFT JOIN js_tbl j ON a.job_id = j.job_id
        WHERE a.job_id = ?
        ORDER BY a.id DESC
    ");
    $stmt->execute([$job_id]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $jobStmt = $pdo->prepare("SELECT * FROM js_tbl WHERE job_id = ?");
    $jobStmt->execute([$job_id]);
    $job = $jobStmt->fetch(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("
        SELECT a.*, j.job_info 
        FROM job_applications a
        LEFT JOIN js_tbl j ON a.job_id = j.job_id
        ORDER BY a.id DESC
    ");
    $stmt->execute();
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $job = null;
}


$jobsStmt = $pdo->query("SELECT job_id, job_info FROM js_tbl ORDER BY job_id");
$jobs = $jobsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/client.css">
    <title>Job Applicants - JobStreet</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .btn-pink {
            background-color: #E60278;
            color: white;
        }
        
        .btn-pink:hover {
            background-color: #c70067;
            color: white;
        }
        
        .btn-blue {
            background-color: #051A49;
            color: white;
        }
        
        .btn-blue:hover {
            background-color: #030f29;
            color: white;
        }
        
        .cv-link {
            color: #051A49;
            text-decoration: none;
            font-weight: 500;
        }
        
        .cv-link:hover {
            text-decoration: underline;
        }
        
        .applicant-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .applicant-email {
            color: #051A49;
            font-weight: 500;
        }
        
        .cover-letter {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            font-style: italic;
            color: #555;
        }
        
        .filter-form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .view-cv-btn {
            background-color: #051A49;
            color: white;
        }
        
        .view-cv-btn:hover {
            background-color: #030f29;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-actions">
            <h1><?php echo $job ? 'Applicants for "' . htmlspecialchars($job['job_info']) . '"' : 'All Job Applicants'; ?></h1>
            <div>
                <a href="admin.php" class="btn btn-blue me-2">Back to Jobs</a>
                <?php if ($job): ?>
                <a href="view_applicants.php" class="btn btn-blue">View All Applicants</a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Filter Form -->
        <div class="filter-form">
            <form action="" method="get" class="row g-3">
                <div class="col-md-6">
                    <label for="job_filter" class="form-label">Filter by Job:</label>
                    <select name="job_id" id="job_filter" class="form-select" onchange="this.form.submit()">
                        <option value="">All Jobs</option>
                        <?php foreach ($jobs as $jobOption): ?>
                        <option value="<?php echo htmlspecialchars($jobOption['job_id']); ?>" <?php echo ($job_id == $jobOption['job_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($jobOption['job_info']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        
        <?php if (empty($applications)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle-fill me-2"></i>
                No applications found for <?php echo $job ? 'this job.' : 'any job.'; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($applications as $app): ?>
                <div class="col-12">
                    <div class="applicant-card">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="applicant-email"><?php echo htmlspecialchars($app['email']); ?></h5>
                                <p>
                                    <strong>Applied for:</strong> 
                                    <?php echo htmlspecialchars($app['job_info'] ?? 'Unknown Job'); ?>
                                </p>
                                
                                <?php if (!empty($app['cover_letter'])): ?>
                                <div class="cover-letter">
                                    <strong>Cover Letter:</strong><br>
                                    <?php echo nl2br(htmlspecialchars($app['cover_letter'])); ?>
                                </div>
                                <?php else: ?>
                                <p class="text-muted"><em>No cover letter provided</em></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="download_cv.php?file=<?php echo urlencode($app['cv_path']); ?>" class="btn view-cv-btn mb-2" target="_blank">
                                    <i class="bi bi-file-earmark-pdf me-2"></i>View CV
                                </a>
                                <div class="text-muted small">
                                    Application ID: <?php echo htmlspecialchars($app['id']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 