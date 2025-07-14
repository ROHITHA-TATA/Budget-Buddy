<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  exit();
}

// Example: Set $msg and $msgType if you want to show a toast
$msg = "";
$msgType = "success"; // or "error" or "info"
// Example: If you want to show a toast after a POST
if (isset($_POST['submit'])) {
    // ... your logic here ...
    // For demonstration, let's say the report is always generated successfully:
    $msg = "Report generated successfully!";
    $msgType = "success";
    // If there was an error:
    // $msg = "Something went wrong!";
    // $msgType = "error";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Budget Buddy - Datewise Expense Report</title>
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
            <a href="expense-datewise-reports.php" class="nav-link active"><i class="fas fa-calendar-day"></i> Daily Reports</a>
            <a href="expense-monthwise-reports.php" class="nav-link"><i class="fas fa-calendar-alt"></i> Monthly Reports</a>
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
            <span class="breadcrumb-item active">Datewise Expense Report</span>
        </nav>
        <section class="content-card p-4 shadow-lg">
            <h2 class="card-title mb-3"><i class="fas fa-calendar-day"></i> Datewise Expense Report</h2>
            <form role="form" method="post" action="" name="bwdatesreport" class="form-modern">
                <div class="form-group">
                    <label for="fromdate"><i class="fas fa-calendar-alt"></i> From Date</label>
                    <input class="form-control" type="date" id="fromdate" name="fromdate" required>
                </div>
                <div class="form-group">
                    <label for="todate"><i class="fas fa-calendar-alt"></i> To Date</label>
                    <input class="form-control" type="date" id="todate" name="todate" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100" name="submit"><i class="fas fa-search"></i> Submit</button>
                </div>
            </form>
						<?php
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $userid = $_SESSION['detsuid'];
    $query = mysqli_query($con, "SELECT * FROM tblexpense WHERE (ExpenseDate BETWEEN '$fromdate' AND '$todate') AND UserId='$userid'");
    if (mysqli_num_rows($query) > 0) {
        echo '<table class="table-modern">';
        echo '<tr><th>Date</th><th>Item</th><th>Cost</th></tr>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['ExpenseDate']) . '</td>';
            echo '<td>' . htmlspecialchars($row['ExpenseItem']) . '</td>';
            echo '<td>' . htmlspecialchars($row['ExpenseCost']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<div class="alert alert-info">No expenses found for the selected dates.</div>';
    }
}
?>
        </section>
    </main>
    <div id="toast" class="toast"></div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modern-scripts.js"></script>
    <?php if(!empty($msg)): ?>
    <script>
        showToast("<?php echo addslashes($msg); ?>", "<?php echo $msgType; ?>");
    </script>
    <?php endif; ?>
</body>
</html>