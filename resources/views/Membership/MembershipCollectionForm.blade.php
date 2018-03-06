@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Fee Collection Form</h1>
</div>
</div>
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('LHMembershipCollection') }}" method="post">
                {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="membership_code" class="active">Membership Code</label>
                    <input type="text" class="form-control" name="membership_code" id="membership_code" placeholder="Membership Code" value="{{ old('membership_code') }}" required>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label for="pay_method" class="active">Payment Method</label>
                    <select class="form-control" name="pay_method" id="pay_method">
                        <option>CASH</option>
                        <option>CHEQUE</option>
                    </select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label for="paid_amount" class="active">Amount</label>
                    <input type="number" class="form-control" name="paid_amount" id="paid_amount" placeholder="Amount" value="{{ old('paid_amount') }}" required>
                </div>
                </div>
            </div>
            <hr>
            <p>Cheque Details (If Any)</p>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="number" class="active">Cheque Number</label>
                    <input type="number" class="form-control" name="cheque_number"  id="number" placeholder="Cheque Number" value="{{ old('cheque_number') }}">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label for="cheque_date" class="active">Cheque Date</label>
                    <input type="date" class="form-control" name="cheque_date" id="cheque_date" placeholder="Cheque Date" value="{{ old('cheque_date') }}">
                </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

</main>
@endsection
