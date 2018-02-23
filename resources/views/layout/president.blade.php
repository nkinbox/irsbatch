<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
        <ul class="nav nav-pills flex-column invisible" data-qp-animate-type="fadeInLeft">
            <li class="logo-nav-item">
                <a class="navbar-brand" href="index.php">
                    <img src="{{ asset('img/photo.jpg') }}">
                </a>
    
            </li>
            <li>
                <h6 class="nav-header">General</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="batch-icon batch-icon-browser-alt"></i>
                    Dashboard 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'SignUpForm') ? ' active' : ''}}" href="{{ route('SignUpForm') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Admission Form
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'PendingApprovals') ? ' active' : ''}}" href="{{ route('PendingApprovals') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Admission Approval
                </a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="ecs-table.php">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    ECS Form
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ecs-details.php">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    ECS Details Month Wise
                </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link{{(request()->route()->getName() == 'ShowOfficeBearer') ? ' active' : ''}}" href="{{ route('ShowOfficeBearer') }}">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    Office Bearers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nominee-table.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Nominee Registration
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deposit-approval.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Deposit Approval
                </a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="card-table.php">
                    <i class="batch-icon batch-icon-star"></i>
                    I-Card
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="income-expense.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Income & Expense Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="balance-sheet.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Balance Sheet
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="loan-form.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Loan form
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="loan-approval.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Loan Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-given.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Loan Given
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-detail.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Loan Repayment Detail
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="certificate.php">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    Loan Clearence Certificate
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pending-loan-priority.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Pending Loan Priority
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('MemberDetails') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Member Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fund-with-him.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Funds With Me
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deposit-fund.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Deposit Fund
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="expenses.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Expenses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="income.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Income
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="member-cancel-table.php">
                    <i class="batch-icon batch-icon-star"></i>
                    MemberShip Cancellation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="requesting-help.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Acknowledge Help
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="grevence-form.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Grevence Form
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="receipt.php">
                    <i class="batch-icon batch-icon-star"></i>
                    Receipt
                </a>
            </li>
    
        </ul>
    </nav>