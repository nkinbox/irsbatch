@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1>Tables</h1>
</div>
</div>
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<!-- <div class="add-field" style="position: absolute;right: 0;">
<a href="ecs.php"><button type="button" class="btn btn-primary">Add New Field</button></a>
</div> -->
<div class="col-lg-12 pb-5">
    <h2>ECS Details By Member</h2>
    <form  action="{{route('ECSByMember')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="member-code" class="active">Membership Code</label>
            <input id="member-code" type="text" class="form-control" name="membership_code" placeholder="Membership Code" value="" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
@if(count($ecs) > 0)
    <table class="table table-responsive" id="example" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Membership Code</th>
                <th>Date</th>
                <th>Bank Name</th>
                <th>IFSC Code</th>
                <th>Account No</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Flag</th>
                <th>PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; ?>
            @foreach($ecs as $ecs_)
            <tr>
                <td><?php $i++; echo $i;?></td>
                <td>{{$ecs_->member_detail->name}}</td>
                <td>{{$ecs_->member_detail->membership_code}}</td>
                <td>{{date('M Y', strtotime('01-'.$ecs_->pdf->ecs_month.'-'.$ecs_->pdf->ecs_year))}}</td>
                <td>{{$ecs_->member_detail->bank_name}}</td>
                <td>{{$ecs_->member_detail->ifsc_code}}</td>
                <td>{{$ecs_->member_detail->acc_no}}</td>
                <td>{{$ecs_->Amount}}</td>
                <td>{{$ecs_->status}}</td>
                <td>{{$ecs_->existance}}</td>
                <td><a href="{{asset('ecs/'.$ecs_->pdf->transactions)}}" target="_blank">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
</div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection