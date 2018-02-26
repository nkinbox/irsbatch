@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<!--div class="add-field" style="position: absolute;right: 0;">
<a href="member-form.php"><button type="button" class="btn btn-primary">Add New Field</button></a>
</div-->
<div class="col-lg-12 pb-5">
    <h2>ECS Tracking</h2>
    @if($ecs_list[0])
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>SNO<br>(in PDF)</th>
                <th>UMRN</th>
                <th>BankCode</th>
                <th>Beneficiary AccNo</th>
                <th>Beneficiary Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Files</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ecs_list[1] as $ecs)
            <tr>
            <td>{{$ecs->SNO}}</td>
            <td>{{$ecs->UMRN}}</td>
            <td>{{$ecs->BankCode}}</td>
            <td>{{$ecs->Beneficiary_AccNo}}</td>
            <td>{{$ecs->Beneficiary_Name}}</td>
            <td>{{$ecs->Amount}}</td>
            <td>{{$ecs->status}}</td>
            <td><a href="{{ asset('ecs/'.$ecs->pdf->transactions) }}" target="_blank">View PDF</a></td>
            </tr>
            @endforeach
        </tbody>


    @else

    @endif
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Membership Code</th>
                <th>HQ</th>
                <th>Phone Number</th>
                <th>WhatsApp No.</th>
                <th>PF No</th>
                <th>Designation</th>
                <th>Bank Name</th>
                <th>Nominee Name</th>
                <th>Nominee Phone No</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach($ecs_list[1] as $ecs)
            Hello
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