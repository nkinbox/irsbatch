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
            <a class="nav-link" href="membership-detail.php">
                <i class="batch-icon batch-icon-star"></i>
                MemberShip Statement
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="member-detail.php">
                <i class="batch-icon batch-icon-star"></i>
                Profile
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="loan-form.php">
                <i class="batch-icon batch-icon-star"></i>
                Loan Form
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link{{(request()->route()->getName() == 'ShowOfficeBearer') ? ' active' : ''}}" href="{{ route('ShowOfficeBearer') }}">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Office Bearers
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="loan-detail.php">
                <i class="batch-icon batch-icon-star"></i>
                Loan Repayment Detail
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="deposit-membership.php">
                <i class="batch-icon batch-icon-star"></i>
                Deposit MemberShip
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="grevence-form.php">
                <i class="batch-icon batch-icon-star"></i>
                Grevience & Suggestion
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="receipt.php">
                <i class="batch-icon batch-icon-star"></i>
                Receipts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pending-loan-priority.php">
                <i class="batch-icon batch-icon-star"></i>
                Pending Loan Priority
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="nominee-reg.php">
                <i class="batch-icon batch-icon-star"></i>
                Nominee Registration
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="member-cancel.php">
                <i class="batch-icon batch-icon-star"></i>
                MemberShip Cancellation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="requesting-help-form.php">
                <i class="batch-icon batch-icon-star"></i>
                Need Help
            </a>
        </li>

        

    </ul>

    
</nav>