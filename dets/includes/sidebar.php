<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<div class="sidebar-modern">
    <div class="sidebar-header">
        <div class="profile-info">
            <div class="profile-avatar">
                <?php
                $uid=$_SESSION['detsuid'];
                $ret=mysqli_query($con,"select FullName from tbluser where ID='$uid'");
                $row=mysqli_fetch_array($ret);
                $name=$row['FullName'];
                echo strtoupper(substr($name, 0, 1));
                ?>
            </div>
            <div class="profile-details">
                <h4><?php echo $name; ?></h4>
                <p><i class="fas fa-circle" style="color: var(--success-color); font-size: 0.6rem;"></i> Online</p>
            </div>
        </div>
    </div>
    
    <nav class="nav-menu">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="add-expense.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add-expense.php' ? 'active' : ''; ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Expense</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="manage-expense.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-expense.php' ? 'active' : ''; ?>">
                    <i class="fas fa-list-alt"></i>
                    <span>Manage Expenses</span>
                </a>
            </li>
            
            <li class="nav-item" style="margin-top: 1rem;">
                <div style="padding: 0.75rem 1.5rem; color: var(--gray-500); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="fas fa-chart-bar"></i> Reports
                </div>
            </li>
            
            <li class="nav-item">
                <a href="expense-datewise-reports.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'expense-datewise-reports.php' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-day"></i>
                    <span>Daily Reports</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="expense-monthwise-reports.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'expense-monthwise-reports.php' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Monthly Reports</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="expense-yearwise-reports.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'expense-yearwise-reports.php' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar"></i>
                    <span>Yearly Reports</span>
                </a>
            </li>
            
            <li class="nav-item" style="margin-top: 1rem;">
                <div style="padding: 0.75rem 1.5rem; color: var(--gray-500); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="fas fa-cog"></i> Settings
                </div>
            </li>
            
            <li class="nav-item">
                <a href="user-profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'user-profile.php' ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="change-password.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'change-password.php' ? 'active' : ''; ?>">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="logout.php" class="nav-link" style="color: var(--danger-color);">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</div>