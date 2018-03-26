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
            <a class="nav-link{{(request()->route()->getName() == 'MembershipDetails') ? ' active' : ''}}" href="{{ route('MembershipDetails') }}">
                <i class="batch-icon batch-icon-star"></i>
                Membership Statement
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{(request()->route()->getName() == 'profile') ? ' active' : ''}}" href="{{ route('profile') }}">
                <i class="batch-icon batch-icon-star"></i>
                Profile
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'LoanForm') ? ' active' : ''}}" href="{{ route('LoanForm') }}">
                <i class="batch-icon batch-icon-star"></i>
                Loan Form
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'LoanRepaymentView') ? ' active' : ''}}" href="{{ route('LoanRepaymentView') }}">
                <i class="batch-icon batch-icon-star"></i>
                Loan Repayment Detail
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'LoanPriority') ? ' active' : ''}}" href="{{ route('LoanPriority') }}">
                <i class="batch-icon batch-icon-star"></i>
                Pending Loan Priority
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ShowOfficeBearer') ? ' active' : ''}}" href="{{ route('ShowOfficeBearer') }}">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Office Bearers
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'PayMembershipForm') ? ' active' : ''}}" href="{{ route('PayMembershipForm') }}">
                <i class="batch-icon batch-icon-star"></i>
                Deposit MemberShip
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'Grievance') ? ' active' : ''}}" href="{{ route('Grievance') }}">
                <i class="batch-icon batch-icon-star"></i>
                Grievance / Suggestion
            </a>
        </li>

        <!--li class="nav-item">
            <a class="nav-link" href="#">
                <i class="batch-icon batch-icon-star"></i>
                Receipts
            </a>
        </li-->
        <li class="nav-item">
            <a class="nav-link{{(request()->route()->getName() == 'NomineeEditForm') ? ' active' : ''}}" href="{{ route('NomineeEditForm') }}">
                <i class="batch-icon batch-icon-star"></i>
                Nominee Registration
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{(request()->route()->getName() == 'MembershipCancellation') ? ' active' : ''}}" href="{{ route('MembershipCancellation') }}">
                <i class="batch-icon batch-icon-star"></i>
                Membership Cancellation
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'HelpList') ? ' active' : ''}}" href="{{ route('HelpList') }}">
                <i class="batch-icon batch-icon-star"></i>
                Need Help
            </a>
        </li>
    </ul>
</nav>