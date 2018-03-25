@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
<div class="card">
<div class="card-body">
<div class="row">
        <!--div class="add-field" style="position: absolute;right: 0;">
        <a href=" route('ChequeCollectionForm') "><button type="button" class="btn btn-primary">Collect Cheques</button></a>
        </div-->
    <div class="col-lg-12 pb-5">
        <h2>Loan Repayment</h2>
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>HQ</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Repaid Amount</th>
                    <th>Unpaid Amount</th>
                    <th>Apply Date</th>
                    <th>Sanction Date</th>
                    <th>Given Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
            @foreach($loans as $loan)
                <tr>
                    <th scope="row"><?php echo ++$i; ?></th>
                    <td>{{ $loan->member_detail->name }}</td>
                    <td>{{ $loan->member_detail->membership_code }}</td>
                    <td>{{ $loan->member_detail->hq }}</td>
                    <td>{{ $loan->loan_type }}</td>
                    <td>{{ $loan->amount }}</td>
                    <?php
                    $paid = 0.0;
                    $unpaid = 0.0;
                    foreach($loan->repayment_cheques as $cheque) {
                        if(empty($cheque->status))
                        $unpaid += $cheque->amount;
                        else
                        $paid += $cheque->amount;
                    }
                    ?>
                    <td>{{ $paid }}</td>
                    <td>{{ $unpaid }}</td>
                    <td>{{ $loan->applied_on }}</td>
                    <td>{{ $loan->sanction_on }}</td>
                    <td>{{ $loan->given_on }}</td>
                    <td>
                    @if(session('mode') == 'president' || session('mode') == 'corecommittee')
                    @if($loan->given_on == null)
                    <a href="{{ route('GiveLoanView', ['loan_id' => $loan->id]) }}">Issue</a> / 
                    @endif
                    <a href="{{ route('ViewLoan', ['loan_id' => $loan->id]) }}">View</a>
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection