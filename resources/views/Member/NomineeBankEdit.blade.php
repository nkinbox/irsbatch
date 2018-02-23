@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Add Nominee Bank</h1>
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
            Nominee Bank
        </p>
        <form  action="{{route('NomineeBankEdit')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankac" class="active">Bank A/c Number</label>
                <input id="nominee_bankac" type="text" class="form-control" name="nominee_acc_no" placeholder="Acc Number" value="{{ old('nominee_acc_no') }}">
            </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankifsc" class="active">IFSC Code</label>
                <input id="nominee_bankifsc" type="text" class="form-control" name="nominee_ifsc_code" placeholder="ifsc_code"  value="{{ old('nominee_ifsc_code') }}">
            </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="nominee_bankname" class="active">Bank Name</label>
                        <input id="nominee_bankname" type="text" class="form-control" name="nominee_bank_name" placeholder="bank_name" value="{{ old('nominee_bank_name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="nominee_branch" class="active">Branch Name</label>
                <input id="nominee_branch" type="text" class="form-control" name="nominee_branch_name" placeholder="branch_name" value="{{ old('nominee_branch_name') }}">
                </div>
                </div>
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