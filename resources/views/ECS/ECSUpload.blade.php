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
        @if (session('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('error') }} <a href="{{ route('Process_ECS', ['step' => 1]) }}">Click Here To Retry ECS Process</a></li>
            </ul>
        </div>
        @endif
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-lg-12 pb-5">
        <a href="http://irsbatch2007.com:8080" target="_blank" class="btn btn-primary" style="float:right">GoTo Tabula</a>
        <h2>UPLOAD ECS</h2>
        <form action="{{route('UploadEcs')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <hr>
            <div class="row">
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">All Transactions PDF</label>
                    <input type="file"  class="form-control" name="docs[0]" required>
                </div>
                </div>
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">All Transactions JSON</label>
                    <input type="file"  class="form-control" name="docs[1]" required>
                </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Returned Transactions PDF</label>
                    <input type="file"  class="form-control" name="docs[2]">
                </div>
                </div>
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Returned Transactions JSON</label>
                    <input type="file"  class="form-control" name="docs[3]">
                </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Rejected Transactions PDF</label>
                    <input type="file"  class="form-control" name="docs[4]">
                </div>
                </div>
                <div class="col-md-6" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Rejected Transactions JSON</label>
                    <input type="file"  class="form-control" name="docs[5]">
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Upload Files</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection