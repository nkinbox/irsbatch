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
            <a class="nav-link" href="#">
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
            <a class="nav-link{{(request()->route()->getName() == 'MembershipDetails') ? ' active' : ''}}" href="{{ route('MembershipDetails') }}">
                <i class="batch-icon batch-icon-star"></i>
                Membership Details
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ShowOfficeBearer') ? ' active' : ''}}" href="{{ route('ShowOfficeBearer') }}">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Office Bearers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{(request()->route()->getName() == 'MemberDetails') ? ' active' : ''}}" href="{{ route('MemberDetails') }}">
                <i class="batch-icon batch-icon-star"></i>
                Members Details
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Loan Approval
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
                Loan Repayment Details
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{(request()->route()->getName() == 'LHMembershipCollectionView') ? ' active' : ''}}" href="{{ route('LHMembershipCollectionView') }}">
                <i class="batch-icon batch-icon-star"></i>
                Membership Collection
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Fund With Me
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Acknowledge Help
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Pending Loan Priority
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Greivience Approval 
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
                Expenses
            </a>
        </li>

    </ul>

    
</nav>