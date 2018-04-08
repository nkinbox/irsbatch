@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Cheque Collection</h1>
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
        <form  action="{{ route('ChequeCollection') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="active">Membership Code</label>
                <input type="text" class="form-control" value="{{ $loan->member_detail->membership_code }}" readonly>
            </div>
            <div class="form-group">
                <label class="active">Type of Loan</label>
                <input type="text" class="form-control" value="{{ $loan->loan_type }}" readonly>
            </div>

            <div class="form-group">
                <label class="active">Loan Amount</label>
                <input type="number" placeholder="Enter Amount" class="form-control" value="{{ $loan->amount }}" readonly>
            </div>
            <hr>
            <div id="ChequeContainer" class="row">
                <?php $i = 0; ?>
                @foreach($loan->repayment_cheques as $cheque)
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="active">{{ $i+1 }}. Cheque Number</label>
                        <input type="number" class="form-control" name="cheque_number[{{$i++}}]" placeholder="Cheque Number" value="{{$cheque->number}}">
                    </div>
                </div>
                @endforeach
            </div>
            <a href="#" id="addNewCheque" class="btn btn-default">Add Cheques</a>
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