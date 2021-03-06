<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
        <ul class="nav nav-pills flex-column invisible" data-qp-animate-type="fadeInLeft">
            <li class="logo-nav-item">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/photo.jpg') }}">
                </a>
    
            </li>
            <li>
                <h6 class="nav-header">General</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'home') ? ' active' : ''}}" href="{{ route('home') }}">
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
                <a class="nav-link{{(request()->route()->getName() == 'ECSForm') ? ' active' : ''}}" href="{{ route('ECSForm') }}">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    ECS Form
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ECSTracking') ? ' active' : ''}}" href="{{ route('ECSTracking') }}">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    ECS Tracking
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ECSByMember') ? ' active' : ''}}" href="{{ route('ECSByMember') }}">
                    <i class="batch-icon batch-icon-compose-alt-2"></i>
                    ECS Details Member Wise
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ECSByMonth') ? ' active' : ''}}" href="{{ route('ECSByMonth') }}">
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
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Nominee Registration
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Deposit Approval
                </a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    I-Card
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Income & Expense Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
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
                <a class="nav-link{{(request()->route()->getName() == 'MemberDetails') ? ' active' : ''}}" href="{{ route('MemberDetails') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Member Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'MembershipDetails') ? ' active' : ''}}" href="{{ route('MembershipDetails') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Membership Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Funds With Me
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Deposit Fund
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Expenses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Income
                </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link{{(request()->route()->getName() == 'CancellationList') ? ' active' : ''}}" href="{{ route('CancellationList') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Membership Cancellation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Acknowledge Help
                </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link{{(request()->route()->getName() == 'Grievance') ? ' active' : ''}}" href="{{ route('Grievance') }}">
                    <i class="batch-icon batch-icon-star"></i>
                    Grievance Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="batch-icon batch-icon-star"></i>
                    Receipt
                </a>
            </li>
    
        </ul>
    </nav>