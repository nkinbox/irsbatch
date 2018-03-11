@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
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
<div class="col-md-12">
<h1 style="text-align: center">Requesting Help in Suspension/Removal/Dismissal/Death</h1>
</div>
</div>
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-12">

<form action="{{ route('GetHelp') }}" id="registration-form" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="name" class="active">Date</label>
        <input type="text" class="form-control" value="{{ date('d-M-Y') }}" readonly>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <label for="name" class="active">MemberShip Code</label>
        <input type="text" class="form-control" value="{{ Auth::user()->membership_code }}" readonly>
    </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="name" class="active">Type of Help Requested (suspension/removal/dismissal/death)</label>
        <select class="form-control" name="help">
            <option{{ (old('help') == "Suspension")?' selected':''}}>Suspension</option>
            <option{{ (old('help') == "Removal")?' selected':''}}>Removal</option>
            <option{{ (old('help') == "Dissmissal")?' selected':''}}>Dissmissal</option>
            <option{{ (old('help') == "Death")?' selected':''}}>Death</option>
        </select>
    </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="name" class="active">Upload Your Request Letter</label>
        <input type="file" class="form-control" name="request_letter" required>
    </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="name" class="active">Upload suspension/removal/dissmissal orders</label>
        <input type="file" class="form-control" name="offical_letter">
    </div>
    </div>
    <div class="col-md-6">
    </div>
</div>

    <div class="text-center">
        <button id="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</main>
@endsection