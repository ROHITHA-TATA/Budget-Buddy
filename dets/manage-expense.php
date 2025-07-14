<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblexpense where ID='$rowid'");
if($query){
echo "<script>alert('Expense deleted successfully!');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy - Manage Expenses</title>
	<link href="css/modern-styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
	<div class="dashboard-container">
		<?php include_once('includes/header.php');?>
		<?php include_once('includes/sidebar.php');?>
		
		<div class="main-content">
			<div class="breadcrumb-modern">
				<div class="breadcrumb-item">
					<a href="dashboard.php" class="breadcrumb-link">
						<i class="fas fa-home"></i> Dashboard
					</a>
				</div>
				<div class="breadcrumb-item">
					<span>Manage Expenses</span>
				</div>
			</div>
			
			<div class="page-header">
				<h1 class="page-title">Manage Expenses</h1>
				<p class="page-subtitle">View and manage all your recorded expenses</p>
			</div>
			
			<div class="content-card">
				<div class="card-header">
					<div class="d-flex align-center justify-between">
						<h3 class="card-title">
							<i class="fas fa-list-alt" style="margin-right: 0.5rem; color: var(--primary-color);"></i>
							All Expenses
						</h3>
						<a href="add-expense.php" class="btn btn-primary">
							<i class="fas fa-plus"></i> Add New Expense
						</a>
					</div>
				</div>
				<div class="card-body">
					<?php
					$userid=$_SESSION['detsuid'];
					$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid' order by ExpenseDate desc");
					$cnt=1;
					?>
					
					<?php if(mysqli_num_rows($ret) > 0): ?>
					<div class="table-responsive">
						<table class="table-modern">
							<thead>
								<tr>
									<th>#</th>
									<th>Item</th>
									<th>Amount</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($row=mysqli_fetch_array($ret)): ?>
								<tr>
									<td><?php echo $cnt;?></td>
									<td>
										<div style="font-weight: 500; color: var(--gray-800);">
											<?php echo $row['ExpenseItem'];?>
										</div>
									</td>
									<td>
										<span style="font-weight: 600; color: var(--danger-color); font-size: 1.1rem;">
											₹<?php echo $row['ExpenseCost'];?>
										</span>
									</td>
									<td>
										<span style="color: var(--gray-600);">
											<?php echo date('M d, Y', strtotime($row['ExpenseDate'])); ?>
										</span>
									</td>
									<td>
										<a href="manage-expense.php?delid=<?php echo $row['ID'];?>" 
										   class="btn btn-danger" 
										   style="padding: 0.5rem 1rem; font-size: 0.9rem;"
										   onclick="return confirm('Are you sure you want to delete this expense?')">
											<i class="fas fa-trash"></i> Delete
										</a>
									</td>
								</tr>
								<?php 
								$cnt=$cnt+1;
								endwhile; 
								?>
							</tbody>
						</table>
					</div>
					
					<div class="mt-4" style="background: var(--gray-50); padding: 1rem; border-radius: 12px;">
						<div class="d-flex align-center justify-between">
							<div>
								<h4 style="color: var(--gray-700); margin-bottom: 0.5rem;">Summary</h4>
								<p style="color: var(--gray-600); margin: 0;">Total expenses: <strong><?php echo $cnt-1; ?></strong> items</p>
							</div>
							<div style="text-align: right;">
								<?php
								$total_query = mysqli_query($con,"select sum(ExpenseCost) as total from tblexpense where UserId='$userid'");
								$total_result = mysqli_fetch_array($total_query);
								$total_amount = $total_result['total'];
								?>
								<h4 style="color: var(--danger-color); margin-bottom: 0.5rem;">₹<?php echo $total_amount ? $total_amount : '0'; ?></h4>
								<p style="color: var(--gray-600); margin: 0;">Total amount</p>
							</div>
						</div>
					</div>
					
					<?php else: ?>
					<div class="text-center" style="padding: 3rem; color: var(--gray-500);">
						<i class="fas fa-inbox" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.5;"></i>
						<h3 style="color: var(--gray-600); margin-bottom: 1rem;">No Expenses Found</h3>
						<p style="margin-bottom: 2rem;">You haven't recorded any expenses yet. Start tracking your spending!</p>
						<a href="add-expense.php" class="btn btn-primary">
							<i class="fas fa-plus"></i> Add Your First Expense
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="content-card">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-chart-bar" style="margin-right: 0.5rem; color: var(--info-color);"></i>
						Quick Actions
					</h3>
				</div>
				<div class="card-body">
					<div class="d-flex align-center" style="flex-wrap: wrap; gap: 1rem;">
						<a href="expense-datewise-reports.php" class="btn btn-info">
							<i class="fas fa-calendar-day"></i> Daily Reports
						</a>
						<a href="expense-monthwise-reports.php" class="btn btn-success">
							<i class="fas fa-calendar-alt"></i> Monthly Reports
						</a>
						<a href="expense-yearwise-reports.php" class="btn btn-warning">
							<i class="fas fa-calendar"></i> Yearly Reports
						</a>
						<a href="dashboard.php" class="btn btn-secondary">
							<i class="fas fa-tachometer-alt"></i> Back to Dashboard
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modern-scripts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('.table-modern tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Show notification when expense is deleted
    const deleteButtons = document.querySelectorAll('a[href*="delid"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (typeof showNotification === 'function') {
                setTimeout(() => {
                    showNotification('Expense deleted successfully!', 'success');
                }, 500);
            }
        });
    });
});
</script>
<div id="toast" class="toast"></div>
</body>
</html>
<?php }  ?>