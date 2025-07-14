<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Budget Buddy - Monthwise Expense Report</title>
    <link href="css/modern-styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar-modern">
        <div class="sidebar-header">
            <span class="navbar-brand"><i class="fas fa-wallet"></i> Budget Buddy</span>
        </div>
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
            <a href="add-expense.php" class="nav-link"><i class="fas fa-plus-circle"></i> Add Expense</a>
            <a href="manage-expense.php" class="nav-link"><i class="fas fa-tasks"></i> Manage Expenses</a>
            <div class="mb-2 mt-3" style="color: var(--gray-400); font-size: 0.9rem; padding-left: 1.5rem;">REPORTS</div>
            <a href="expense-datewise-reports.php" class="nav-link"><i class="fas fa-calendar-day"></i> Daily Reports</a>
            <a href="expense-monthwise-reports.php" class="nav-link active"><i class="fas fa-calendar-alt"></i> Monthly Reports</a>
            <a href="expense-yearwise-reports.php" class="nav-link"><i class="fas fa-calendar"></i> Yearly Reports</a>
            <div class="mb-2 mt-3" style="color: var(--gray-400); font-size: 0.9rem; padding-left: 1.5rem;">SETTINGS</div>
            <a href="user-profile.php" class="nav-link"><i class="fas fa-user"></i> Profile</a>
            <a href="change-password.php" class="nav-link"><i class="fas fa-key"></i> Change Password</a>
            <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" style="margin-left: 280px; min-height: 100vh;">
        <header class="navbar-modern d-flex align-center justify-between mb-4" style="position: static;">
            <div class="d-flex align-center">
                <span class="navbar-brand"><i class="fas fa-wallet"></i> Budget Buddy</span>
            </div>
            <div class="d-flex align-center" style="gap: 1rem;">
                <span style="font-weight: 500;"><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['detsuname'] ?? 'User'); ?></span>
            </div>
        </header>
        <nav class="breadcrumb-modern mb-4">
            <span class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link"><i class="fas fa-home"></i> Home</a></span>
            <span class="breadcrumb-item active">Monthwise Expense Report</span>
        </nav>
        <section class="content-card p-4 shadow-lg">
            <h2 class="card-title mb-3"><i class="fas fa-calendar-alt"></i> Monthwise Expense Report</h2>
            <form role="form" method="post" action="expense-monthwise-reports-detailed.php" name="bwdatesreport" class="form-modern">
                <div class="form-group">
                    <label for="month"><i class="fas fa-calendar-alt"></i> Select Month</label>
                    <input class="form-control" type="month" id="month" name="month" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100" name="submit"><i class="fas fa-search"></i> Submit</button>
                </div>
            </form>
        </section>
    </main>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modern-scripts.js"></script>
</body>
</html>
