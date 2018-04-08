@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-lg-12 pb-5">
        <h2>Loan Request</h2>
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>HQ</th>
                    <th>Loan Request(Amount)</th>
                    <th>Loan Type</th>
                    <th>No of Cheques Received</th>
                    <th>Date</th>
                    <th>Loan Form No</th>
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
                    <td>{{ $loan->amount }}</td>
                    <td>{{ $loan->loan_type }}</td>
                    <td>{{ count($loan->repayment_cheques) }}</td>
                    <td>{{ $loan->applied_on }}</td>
                    <td>{{ $loan->id }}</td>
                    <td><a href="{{ route('ChequeCollectionForm', ['loan_id' => $loan->id ]) }}">Collect Cheque</a></td>
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