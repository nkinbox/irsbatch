@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">LOAN APPLICATION</h1>
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
        <form  action="{{ route('AddLoan') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="active">Type of Loan</label>
                <select class="form-control" name="loan_type">
                    <option{{ (old('loan_type') == "Normal")?' selected':''}}>Normal</option>
                    <option{{ (old('loan_type') == "Emergency")?' selected':''}}>Emergency</option>
                </select>
            </div>
            <div class="form-group">
                <label class="active">Select Range</label>
                <?php                
                $d1 = new DateTime(Auth::user()->approved_on);
                $d2 = new DateTime(date('Y-m-d'));
                $diff = $d2->diff($d1);
                $years = $diff->y;
                ?>
                <select class="form-control" name="loan_range" id="loan_range">
                    <option value="0" selected>-- Select Range --</option>
                    <option value="1">0 - 49,000</option>
                    <option value="2">50,000 - 99,999</option>
                    <option value="3">1,00,000 - 1,49,999</option>
                    <option value="4">1,50,000 - 1,99,999</option>
                    <option value="5"{{($years < 3)?' disabled':''}}>2,00,000 - 2,99,999</option>
                    <option value="6"{{($years < 3)?' disabled':''}}>3,00,000 +</option>
                </select>
            </div>
            <div class="form-group">
                <label class="active">Enter Amount</label>
                <input type="number" name="amount" placeholder="Enter Amount" class="form-control">
            </div>
            <hr>
            <div id="ChequeContainer" class="row"></div>
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