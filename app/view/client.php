<?php
session_start();
$pdo = require_once '../model/database.php';

$items_per_page = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$total_items = $pdo->query("SELECT COUNT(*) FROM js_tbl")->fetchColumn();
$total_pages = ceil($total_items / $items_per_page);

if ($page > $total_pages && $total_pages > 0) $page = $total_pages;

$offset = ($page - 1) * $items_per_page;

$jobs = $pdo->prepare("SELECT * FROM js_tbl LIMIT :limit OFFSET :offset");
$jobs->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
$jobs->bindParam(':offset', $offset, PDO::PARAM_INT);
$jobs->execute();
$jobs = $jobs->fetchAll(PDO::FETCH_ASSOC);

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/client.css">
    <title>JobStreet</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-content .logout {
            color: #E60278;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 2rem auto;
            width: fit-content;
        }
        
        .pagination .active .page-link {
            background-color: #051A49;
            border-color: #051A49;
            color: white;
        }
        
        .pagination .page-link {
            color: #051A49;
            padding: 0.5rem 0.75rem;
            border-radius: 0;
            border: 1px solid #dee2e6;
            margin: 0 2px;
        }
        
        .pagination .page-link:hover {
            color: #051A49;
            background-color: #e9ecef;
        }
        
        .pagination .disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
        }
        
        .pagination-container {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        
        .job-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1.25rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            background-color: #fff;
        }
        
        .job-card h2 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .new-badge {
            display: inline-block;
            background-color: #e8f5e9;
            color: #388e3c;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            margin-bottom: 0.75rem;
        }
        
        .job-location, .job-salary {
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 0.9rem;
        }
        
        .job-description-container {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        
        details summary {
            cursor: pointer;
            color: #051A49;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        details p {
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.5rem;
        }
        
        .quick-apply-btn {
            margin-top: auto;
            background-color: #051A49;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }
        
        .quick-apply-btn:hover {
            background-color: #030f29;
        }
        
        .quick-apply-btn i {
            margin-right: 0.5rem;
        }
        
        .cv-upload-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 550px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .modal-content h2 {
            color: #0d3880;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .job-title-display {
            background-color: #f5f8ff;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        #modal-job-title {
            font-weight: bold;
            color: #0d3880;
        }
        
        .close-modal {
            color: #aaa;
            float: right;
            font-size: 1.75rem;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            margin-top: -0.5rem;
        }
        
        .close-modal:hover {
            color: #555;
        }
        
        .submit-cv {
            background-color: #051A49;
            border-color: #051A49;
        }
        
        .submit-cv:hover {
            background-color: #030f29;
            border-color: #030f29;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <nav class="nav-container">
            <div class="nav-content">
                <div class="logo">
                    <a href="/">
                            <svg viewBox="0 0 248 66" height="40" class="o3fpgs4z _1xd9sxs9 gxyy3e0"><circle cy="32.98" cx="32.98" r="30" fill="#fff" class="_1xd9sxse"></circle><mask id="jobStreetCutArrowOutOfCircle"><circle fill="white" cx="32.98" cy="32.98" r="32.98"></circle><path fill="black" d="M33.76 12.58c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M40.18 19.51c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 19.51c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.93-2.06-2.06M47 26.46c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 27.87 47 26.46M40.18 26.44c0-1.26 1.02-2.27 2.27-2.27s2.28 1.02 2.28 2.27-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 26.44c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 26.44c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 26.44c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.55-1.54 1.55-1.54-.69-1.54-1.55M17.66 26.44c0-.71.58-1.29 1.29-1.29s1.29.58 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 26.44c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 26.44c0-.43.34-.77.77-.77s.77.35.77.77-.35.77-.77.77-.77-.35-.77-.77M6.33 26.44c0-.29.23-.51.52-.51s.51.23.51.51-.23.52-.51.52-.52-.23-.52-.52M47 33.39c0-1.41 1.14-2.55 2.55-2.55s2.55 1.15 2.55 2.55-1.14 2.55-2.55 2.55S47 34.8 47 33.39M40.18 33.37c0-1.26 1.02-2.27 2.27-2.27s2.28 1.01 2.28 2.27-1.02 2.28-2.28 2.28-2.27-1.02-2.27-2.28M33.76 33.37c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 33.37c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 33.37c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.54M17.66 33.37c0-.71.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 33.37c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 33.37c0-.43.34-.78.77-.78s.77.35.77.78-.35.77-.77.77-.77-.35-.77-.77M6.33 33.37c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M54 33.44c0-1.55 1.26-2.8 2.8-2.8s2.8 1.25 2.8 2.8-1.25 2.79-2.8 2.79-2.8-1.25-2.8-2.79M47 40.32c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 41.73 47 40.32M40.18 40.3c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 40.3c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 40.3c0-1 .81-1.81 1.8-1.81s1.81.81 1.81 1.81-.81 1.8-1.81 1.8-1.8-.8-1.8-1.8M22.53 40.3c0-.86.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.54M17.66 40.3c0-.72.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 40.3c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 40.3c0-.43.34-.78.77-.78s.77.35.77.78-.35.77-.77.77-.77-.35-.77-.77M6.33 40.3c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M40.18 47.23c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 47.23c0-1.14.92-2.07 2.06-2.07s2.06.93 2.06 2.07-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M33.76 54.16c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06"></path></mask><circle fill="#0d3880" class="_1xd9sxsd" cx="32.98" cy="32.98" r="32.98" mask="url(#jobStreetCutArrowOutOfCircle)"></circle><path fill="#000" class="_1xd9sxsf" d="M82.79 17.04h-5.98V12.2h5.98v4.84Zm0 29.92c0 1.86-.55 3.41-1.64 4.66-1.25 1.43-3.01 2.15-5.3 2.15h-3.38v-5.02h2.26c1.39 0 2.08-.72 2.08-2.15V21.07h5.98v25.9ZM100.97 32.94c0-2.92-.45-4.84-1.36-5.76-.69-.7-1.61-1.05-2.76-1.05s-2.02.35-2.71 1.05c-.9.91-1.36 2.83-1.36 5.76s.45 4.89 1.36 5.8c.69.7 1.6 1.05 2.71 1.05s2.06-.35 2.76-1.05c.9-.91 1.36-2.85 1.36-5.8m5.98 0c0 2.28-.18 4.1-.55 5.44-.4 1.49-1.11 2.77-2.15 3.84-1.86 1.95-4.32 2.92-7.4 2.92s-5.5-.97-7.35-2.92c-1.04-1.07-1.75-2.34-2.15-3.84-.37-1.34-.55-3.15-.55-5.44 0-4.26.91-7.35 2.74-9.27s4.26-2.88 7.31-2.88 5.53.96 7.35 2.88c1.83 1.92 2.74 5.01 2.74 9.27M124.99 32.94c0-2.1-.17-3.61-.5-4.52-.6-1.52-1.76-2.28-3.48-2.28s-2.88.76-3.48 2.28c-.33.91-.5 2.42-.5 4.52s.17 3.61.5 4.52c.6 1.55 1.76 2.33 3.48 2.33s2.87-.78 3.48-2.33c.33-.91.5-2.42.5-4.52m5.98 0c0 2.44-.11 4.26-.32 5.48-.34 1.98-1.04 3.5-2.1 4.57-1.43 1.43-3.37 2.15-5.8 2.15s-4.42-.84-5.94-2.51v2.24h-5.76V12.34h5.98v10.83c1.43-1.58 3.34-2.37 5.74-2.37s4.36.72 5.78 2.15c1.06 1.07 1.76 2.59 2.09 4.57.21 1.22.32 3.03.32 5.44M153.04 37.37c0 2.53-.98 4.48-2.92 5.85-1.83 1.28-4.22 1.92-7.17 1.92-2.22 0-4.04-.2-5.44-.59-1.77-.52-3.33-1.46-4.71-2.83l3.88-3.88c1.49 1.49 3.61 2.24 6.35 2.24s4.2-.82 4.2-2.47c0-1.31-.84-2.04-2.51-2.19l-3.75-.37c-4.63-.46-6.94-2.68-6.94-6.67 0-2.37.93-4.26 2.79-5.66 1.7-1.28 3.84-1.92 6.39-1.92 4.08 0 7.11.93 9.09 2.79l-3.65 3.7c-1.19-1.07-3.03-1.6-5.53-1.6-2.25 0-3.38.76-3.38 2.28 0 1.22.82 1.9 2.47 2.06l3.75.37c4.72.46 7.08 2.79 7.08 6.99M167.16 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02ZM188.35 23.02l-4.48 4.52c-.94-.94-1.99-1.42-3.15-1.42-1.01 0-1.87.35-2.6 1.05-.82.82-1.23 1.93-1.23 3.33v14.34h-5.94v-23.8h5.8v2.28c1.43-1.7 3.43-2.56 5.98-2.56 2.25 0 4.13.75 5.62 2.24M203.88 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84.93.97 2.2 1.46 3.81 1.46 2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM227.36 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84s2.2 1.46 3.81 1.46c2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM247.87 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02Z"></path>
                        </svg>
                    </a>
                </div>
                <div class="nav-links">
                    <a href="">Job search</a>
                    <a href="/client.php">Job List</a>
                    <a href="/user.php">Home</a>
                    <a href="/about.php">About</a>
                    <a href="/faq.php">FAQ</a>
                    <a href="/contact.php">Contact</a>
                </div>
                <div class="user">
                    <div class="username">
                        <span class="user-link user-profile"><?php echo htmlspecialchars($username); ?></span>
                        <div class="dropdown">
                            <a href="#" class="user-link profile-link">Profile</a>
                            <div class="dropdown-content">
                                <a href="#">My Profile</a>
                                <a href="#">Settings</a>
                                <a href="auth/logout.php" class="logout">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="banner">
            <div class="search-container">
                <div class="search-row">
                    <div class="search-column">
                        <label class="search-label">What</label>
                        <input class="search-input" type="text" placeholder="Enter keywords">
                    </div>
                    
                    <div class="search-column">
                        <label class="search-where">Where</label>
                        <input class="where" type="text" placeholder="Enter city, or region">
                    </div>
                    <button class="seek-button">SEEK</button>
                </div>
            </div>
            <div class="more-options">
                <a href="#">More options</a>
            </div>
        </div>
        
        <?php if (isset($_SESSION['cv_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                <?php echo htmlspecialchars($_SESSION['cv_success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['cv_success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['cv_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                <?php echo htmlspecialchars($_SESSION['cv_error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['cv_error']); ?>
        <?php endif; ?>
        
        <section class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                        <div class="col-md-4 mb-4">
                            <div class="job-card h-100">
                                <h2><?php echo htmlspecialchars($job['job_info'] ?? 'JobTitle'); ?></h2>
                                <div class="new-badge">New to you</div>
                                <div class="job-location"><?php echo htmlspecialchars($job['location'] ?? 'Philippines'); ?></div>
                                <div class="job-salary">₱<?php echo number_format($job['salary'] ?? 00000); ?> per month</div>
                                <div class="job-description-container">
                                    <details>
                                        <summary>Click for job description</summary>
                                        <p><?php echo nl2br(htmlspecialchars($job['description'] ?? 'No Data')); ?></p>
                                    </details>
                                </div>
                                <button class="quick-apply-btn" data-job-id="<?php echo (isset($job['job_id']) && !empty($job['job_id'])) ? htmlspecialchars($job['job_id']) : '0'; ?>">
                                    <i class="bi bi-file-earmark-arrow-up"></i> Quick Apply
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p>No job listings found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <?php if ($total_pages >= 1): ?>
        <div class="pagination-container">
            <nav aria-label="Job listing pagination">
                <ul class="pagination">
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    $range = 2;
                    $start_page = max(1, $page - $range);
                    $end_page = min($total_pages, $page + $range);
                    
                    if ($start_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                        if ($start_page > 2) {
                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                        }
                    }
                    
                    for ($i = $start_page; $i <= $end_page; $i++) {
                        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
                        echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                        echo '</li>';
                    }
                    
                    if ($end_page < $total_pages) {
                        if ($end_page < $total_pages - 1) {
                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                    }
                    ?>
                    
                    <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>
    <div class="cv-upload-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Upload Your CV</h2>
            <p class="job-title-display">Apply for: <span id="modal-job-title"></span></p>
            <form action="process_cv.php" method="post" enctype="multipart/form-data" id="cv-upload-form">
                <input type="hidden" name="job_id" id="job-id-input">
                <div class="form-group mb-3">
                    <label for="cv-file" class="form-label">Select your CV (PDF, DOC, DOCX)</label>
                    <input type="file" class="form-control" id="cv-file" name="cv" accept=".pdf,.doc,.docx">
                    <div class="form-text">Maximum file size: 5MB (Note: Files are not stored)</div>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="cover-letter" class="form-label">Cover Letter (Optional)</label>
                    <textarea class="form-control" id="cover-letter" name="cover_letter" rows="4"></textarea>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-secondary me-2 cancel-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary submit-cv">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.querySelector(".cv-upload-modal");
            const quickApplyButtons = document.querySelectorAll(".quick-apply-btn");
            const closeModal = document.querySelector(".close-modal");
            const cancelBtn = document.querySelector(".cancel-btn");
            const jobIdInput = document.getElementById("job-id-input");
            const modalJobTitle = document.getElementById("modal-job-title");
            const cvUploadForm = document.getElementById("cv-upload-form");
            
            quickApplyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-job-id');
                    const jobTitle = this.closest('.job-card').querySelector('h2').textContent;
                    
                    if (!jobId || jobId === '0' || jobId === 'undefined') {
                        alert('Error: Unable to determine job ID. Please try another job listing.');
                        return;
                    }
                    
                    jobIdInput.value = jobId;
                    modalJobTitle.textContent = jobTitle;
                    
                    modal.style.display = "block";
                });
            });
            
            closeModal.addEventListener('click', function() {
                modal.style.display = "none";
                cvUploadForm.reset();
            });
            
            cancelBtn.addEventListener('click', function() {
                modal.style.display = "none";
                cvUploadForm.reset();
            });
            
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    cvUploadForm.reset();
                }
            });
            
            cvUploadForm.addEventListener('submit', function(event) {
                const emailInput = document.getElementById('email');
                
                if (!emailInput.value) {
                    event.preventDefault();
                    alert('Please enter your email address');
                    return false;
                }
                
                const fileInput = document.getElementById('cv-file');
                if (fileInput.files.length > 0 && fileInput.files[0].size > 5 * 1024 * 1024) {
                    event.preventDefault();
                    alert('File size exceeds 5MB. Please upload a smaller file or leave empty.');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>