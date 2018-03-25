@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Give Loan</h1>
</div>
</div>
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
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-lg-12">
        <p class="lead" style="font-weight: bold">
            Loan Details
        </p>
        <form  action="{{ route('GiveLoan') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="active">Name</label>
                <input type="text" class="form-control" value="{{ $loan->member_detail->name }}" readonly>
            </div>
            <div class="form-group">
                <label class="active">Membership Code</label>
                <input type="text" class="form-control" value="{{ $loan->member_detail->membership_code }}" readonly>
            </div>
            <div class="form-group">
                <label class="active">Amount</label>
                <input type="text" class="form-control" value="{{ $loan->amount }}" readonly>
            </div>
            <input type="hidden" name="loan_id" value="{{ $loan->id }}">
            <hr>
            Cheque Number(s) given as Loan Amount
            <a href="#" id="addNewCheque" class="btn btn-primary">Add Cheque</a>
            <div id="ChequeContainer" class="row">
                    <div class="col-md-3"><div class="form-group"><label class="active">1. Cheque Number</label>
                        <input type="number" class="form-control" name="cheque_number[0]" placeholder="Cheque Number" required>
                        <input type="date" name="cheque_date[0]" class="form-control" required>
                        <input type="number" name="cheque_amount[0]" class="form-control" placeholder="Cheque Amount" required>
                    </div></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>

</main>

@endsection