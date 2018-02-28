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
<div class="col-lg-12 pb-5">
    <h2>ECS Table</h2>
@if(count($members) > 0)
    <table class="table table-responsive" id="example" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Membership Code</th>
                <th>Phone</th>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>IFSC Code</th>
                <th>Account Number</th>                
            </tr>
        </thead>
        <tbody>
            <?php $i=0; ?>
            @foreach($members as $member)
            <tr>
                <td><?php $i++; echo $i;?></td>
                <td>{{$member->name}}</td>
                <td>{{$member->membership_code}}</td>
                <td>{{$member->mobile_no}}</td>
                <td>{{$member->bank_name}}</td>
                <td>{{$member->branch_name}}</td>
                <td>{{$member->ifsc_code}}</td>
                <td>{{$member->acc_no}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
<p>
    No Data Found
</p>
@endif
</div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection