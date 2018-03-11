@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
    <div class="add-field" style="position: absolute;right: 0;">
        <a href="{{ route('GrievanceMember') }}"><button type="button" class="btn btn-primary">File Grievance</button></a>
    </div>
    <div class="col-lg-12 pb-5">
        <br>
        <h2>Grievance / Suggestions</h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>HQ</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach($list as $list_)
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td>{{ date('d-F-Y', strtotime($list_->created_at)) }}</td>
                    <td>{{ $list_->member_detail->name }}</td>
                    <td>{{ $list_->member_detail->membership_code }}</td>
                    <td>{{ $list_->member_detail->hq }}</td>
                    <td><a href="{{ route('GrievanceShow', ['id' => $list_->id]) }}">View</a></td>
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