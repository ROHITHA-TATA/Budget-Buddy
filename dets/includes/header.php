<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<nav class="navbar-modern">
    <div class="d-flex align-center justify-between w-100">
        <div class="d-flex align-center">
            <button type="button" class="btn btn-secondary" id="sidebar-toggle" style="margin-right: 1rem; display: none;">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="dashboard.php">
                <i class="fas fa-wallet" style="margin-right: 0.5rem;"></i>
                Budget Buddy
            </a>
        </div>
        
        <div class="d-flex align-center">
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span style="margin-left: 0.5rem;"><?php 
                        $uid=$_SESSION['detsuid'];
                        $ret=mysqli_query($con,"select FullName from tbluser where ID='$uid'");
                        $row=mysqli_fetch_array($ret);
                        echo $row['FullName'];
                    ?></span>
                    <i class="fas fa-chevron-down" style="margin-left: 0.5rem; font-size: 0.8rem;"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="userDropdown" style="position: absolute; right: 0; top: 100%; background: white; border-radius: 12px; box-shadow: var(--shadow-lg); border: 1px solid var(--gray-200); min-width: 200px; z-index: 1000;">
                    <a class="dropdown-item" href="user-profile.php" style="padding: 0.75rem 1rem; color: var(--gray-700); text-decoration: none; display: block; border-bottom: 1px solid var(--gray-100);">
                        <i class="fas fa-user-circle" style="margin-right: 0.5rem;"></i> Profile
                    </a>
                    <a class="dropdown-item" href="change-password.php" style="padding: 0.75rem 1rem; color: var(--gray-700); text-decoration: none; display: block; border-bottom: 1px solid var(--gray-100);">
                        <i class="fas fa-key" style="margin-right: 0.5rem;"></i> Change Password
                    </a>
                    <a class="dropdown-item" href="logout.php" style="padding: 0.75rem 1rem; color: var(--danger-color); text-decoration: none; display: block;">
                        <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar-modern');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        }
    });
    
    // Show sidebar toggle on mobile
    function checkWidth() {
        if (window.innerWidth <= 1024) {
            sidebarToggle.style.display = 'block';
        } else {
            sidebarToggle.style.display = 'none';
        }
    }
    
    checkWidth();
    window.addEventListener('resize', checkWidth);
});
</script>