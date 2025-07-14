<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy - Dashboard</title>
	<link href="css/modern-styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
	<div class="dashboard-container">
		<?php include_once('includes/header.php');?>
		<?php include_once('includes/sidebar.php');?>
		
		<div class="main-content">
			<div class="page-header">
				<h1 class="page-title">Dashboard</h1>
				<p class="page-subtitle">Welcome back! Here's your financial overview</p>
			</div>
			
			<div class="stats-grid">
				<?php
				//Today Expense
				$userid=$_SESSION['detsuid'];
				$tdate=date('Y-m-d');
				$query=mysqli_query($con,"select sum(ExpenseCost)  as todaysexpense from tblexpense where (ExpenseDate)='$tdate' && (UserId='$userid');");
				$result=mysqli_fetch_array($query);
				$sum_today_expense=$result['todaysexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Today's Expense</div>
						<div class="stat-icon blue">
							<i class="fas fa-calendar-day"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_today_expense ? $sum_today_expense : '0'; ?></div>
					<div class="stat-change">Today's spending</div>
				</div>

				<?php
				//Yesterday Expense
				$userid=$_SESSION['detsuid'];
				$ydate=date('Y-m-d',strtotime("-1 days"));
				$query1=mysqli_query($con,"select sum(ExpenseCost)  as yesterdayexpense from tblexpense where (ExpenseDate)='$ydate' && (UserId='$userid');");
				$result1=mysqli_fetch_array($query1);
				$sum_yesterday_expense=$result1['yesterdayexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Yesterday's Expense</div>
						<div class="stat-icon orange">
							<i class="fas fa-calendar-check"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_yesterday_expense ? $sum_yesterday_expense : '0'; ?></div>
					<div class="stat-change">Previous day spending</div>
				</div>

				<?php
				//Weekly Expense
				$userid=$_SESSION['detsuid'];
				$pastdate=  date("Y-m-d", strtotime("-1 week")); 
				$crrntdte=date("Y-m-d");
				$query2=mysqli_query($con,"select sum(ExpenseCost)  as weeklyexpense from tblexpense where ((ExpenseDate) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
				$result2=mysqli_fetch_array($query2);
				$sum_weekly_expense=$result2['weeklyexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Last 7 Days</div>
						<div class="stat-icon teal">
							<i class="fas fa-calendar-week"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_weekly_expense ? $sum_weekly_expense : '0'; ?></div>
					<div class="stat-change">Weekly spending</div>
				</div>

				<?php
				//Monthly Expense
				$userid=$_SESSION['detsuid'];
				$monthdate=  date("Y-m-d", strtotime("-1 month")); 
				$crrntdte=date("Y-m-d");
				$query3=mysqli_query($con,"select sum(ExpenseCost)  as monthlyexpense from tblexpense where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
				$result3=mysqli_fetch_array($query3);
				$sum_monthly_expense=$result3['monthlyexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Last 30 Days</div>
						<div class="stat-icon green">
							<i class="fas fa-calendar-alt"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_monthly_expense ? $sum_monthly_expense : '0'; ?></div>
					<div class="stat-change">Monthly spending</div>
				</div>

				<?php
				//Yearly Expense
				$userid=$_SESSION['detsuid'];
				$cyear= date("Y");
				$query4=mysqli_query($con,"select sum(ExpenseCost)  as yearlyexpense from tblexpense where (year(ExpenseDate)='$cyear') && (UserId='$userid');");
				$result4=mysqli_fetch_array($query4);
				$sum_yearly_expense=$result4['yearlyexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Current Year</div>
						<div class="stat-icon red">
							<i class="fas fa-calendar"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_yearly_expense ? $sum_yearly_expense : '0'; ?></div>
					<div class="stat-change">Yearly spending</div>
				</div>

				<?php
				//Total Expense
				$userid=$_SESSION['detsuid'];
				$query5=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
				$result5=mysqli_fetch_array($query5);
				$sum_total_expense=$result5['totalexpense'];
				?>
				<div class="stat-card fade-in">
					<div class="stat-header">
						<div class="stat-title">Total Expenses</div>
						<div class="stat-icon blue">
							<i class="fas fa-chart-line"></i>
						</div>
					</div>
					<div class="stat-value">₹<?php echo $sum_total_expense ? $sum_total_expense : '0'; ?></div>
					<div class="stat-change">All time spending</div>
				</div>
			</div>

			<div class="content-card">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-plus-circle" style="margin-right: 0.5rem; color: var(--primary-color);"></i>
						Quick Actions
					</h3>
				</div>
				<div class="card-body">
					<div class="d-flex align-center justify-between" style="flex-wrap: wrap; gap: 1rem;">
						<a href="add-expense.php" class="btn btn-primary">
							<i class="fas fa-plus"></i> Add New Expense
						</a>
						<a href="manage-expense.php" class="btn btn-secondary">
							<i class="fas fa-list"></i> View All Expenses
						</a>
						<a href="expense-datewise-reports.php" class="btn btn-info">
							<i class="fas fa-chart-bar"></i> View Reports
						</a>
						<a href="user-profile.php" class="btn btn-success">
							<i class="fas fa-user"></i> Update Profile
						</a>
					</div>
				</div>
			</div>

			<?php
			// Recent Expenses
			$userid=$_SESSION['detsuid'];
			$query6=mysqli_query($con,"select * from tblexpense where UserId='$userid' order by ID desc limit 5");
			?>
			<div class="content-card">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-clock" style="margin-right: 0.5rem; color: var(--primary-color);"></i>
						Recent Expenses
					</h3>
				</div>
				<div class="card-body">
					<?php if(mysqli_num_rows($query6) > 0): ?>
					<div class="table-responsive">
						<table class="table-modern">
							<thead>
								<tr>
									<th>Date</th>
									<th>Item</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php while($row=mysqli_fetch_array($query6)): ?>
								<tr>
									<td><?php echo date('M d, Y', strtotime($row['ExpenseDate'])); ?></td>
									<td><?php echo $row['ExpenseItem']; ?></td>
									<td style="font-weight: 600; color: var(--danger-color);">₹<?php echo $row['ExpenseCost']; ?></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
					<?php else: ?>
					<div class="text-center" style="padding: 2rem; color: var(--gray-500);">
						<i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
						<p>No expenses recorded yet</p>
						<a href="add-expense.php" class="btn btn-primary mt-3">
							<i class="fas fa-plus"></i> Add Your First Expense
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modern-scripts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation delay to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Show welcome notification
    setTimeout(() => {
        if (typeof showNotification === 'function') {
            showNotification('Welcome back! Your dashboard is ready.', 'success');
        }
    }, 1000);
});
</script>
</body>
</html>
<?php }  ?>