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
            <a class="nav-link" href="ecs-table.php">
                <i class="batch-icon batch-icon-star"></i>
                ECS Details Member Wise
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ecs-details.php">
                <i class="batch-icon batch-icon-star"></i>
                ECS Detail Month Wise
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="membership-detail.php">
                <i class="batch-icon batch-icon-star"></i>
                MemberShip Details
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ShowOfficeBearer') ? ' active' : ''}}" href="{{ route('ShowOfficeBearer') }}">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Office Bearers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('MemberDetails') }}">
                <i class="batch-icon batch-icon-star"></i>
                Members Details
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="loan-request.php">
                <i class="batch-icon batch-icon-star"></i>
                Loan Approval
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="deposit-fund.php">
                <i class="batch-icon batch-icon-star"></i>
                Deposit Fund
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="loan-detail.php">
                <i class="batch-icon batch-icon-star"></i>
                Loan Repayment Details
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="fee-collectio.php">
                <i class="batch-icon batch-icon-star"></i>
                MemberShip Fee Collection
            </a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="fund-with-him.php">
                <i class="batch-icon batch-icon-star"></i>
                Fund With Me
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="requesting-help.php">
                <i class="batch-icon batch-icon-star"></i>
                Acknowledge Help
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pending-loan-priority.php">
                <i class="batch-icon batch-icon-star"></i>
                Pending Loan Priority
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="grevence-form.php">
                <i class="batch-icon batch-icon-star"></i>
                Greivience Approval 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="member-cancel-table.php">
                <i class="batch-icon batch-icon-star"></i>
                MemberShip Cancellation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="expenses.php">
                <i class="batch-icon batch-icon-star"></i>
                Expenses
            </a>
        </li>

    </ul>

    
</nav>