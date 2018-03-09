@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Cancellation Of MemberShip</h1>
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
        @if (session('e_message'))
        <div class="alert alert-danger">
            {{ session('e_message') }}
        </div>
        @endif
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-lg-12">
        <!-- <p class="lead" style="font-weight: bold">
            Nominee Details
        </p> -->
        <form action="{{route('MembershipCancellation')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="active">Date</label>
                <input type="text" class="form-control" value="{{ date('d-F-Y') }}" disabled>
            </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="form-group">
            <label for="Reason" class="active">Reason for Cancellation</label>
            <textarea rows="5" wrap="hard" id="Reason" type="text" class="form-control" name="reason" placeholder="Reason for Cancellation">{{ old('reason') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="signature" class="active">Sign Of Member</label>
                <input type="file" class="form-control" name="signature"  id="signature" placeholder="Upload Member Signature">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="letter" class="active">Upload Your Request Letter</label>
                <input type="file" class="form-control" name="letter" id="letter" placeholder="Upload Your Request Letter">
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