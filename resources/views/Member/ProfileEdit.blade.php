@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Edit Member Details</h1>
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
            Member Details
        </p>
        <form  action="{{route('ProfileEdit')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="Address" class="active">Current Address</label>
                <textarea rows="5" wrap="hard" id="Address" type="text" class="form-control" name="address" placeholder="current_address">{{ old('address') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile" class="active">Mobile Number</label>
                    <input id="mobile" type="text" class="form-control" name="mobile_no" placeholder="mobile_no" value="{{ old('mobile_no') }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="whatsapp_no" class="active">WhatsApp Mobile Number</label>
                    <input id="whatsapp_no" type="text" class="form-control" name="whatsapp_no" placeholder="whatsapp_no" value="{{ old('whatsapp_no') }}">
                </div>
                </div>
            </div>
            <br>
            <p class="lead" style="font-weight: bold">
            Upload Documents
            </p>
            <a href="#" class="btn btn-default" id="addNewDoc">Add New Document</a>
            <div class="row" id="docsContainer">
                <div class="col-md-3" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Document Name</label>
                    <input type="text"  class="form-control" name="docs_name[0]" placeholder="Document Name" value="">
                    <input type="file"  class="form-control" name="docs[0][]" multiple>
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