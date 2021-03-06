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
<div class="card">
<div class="card-body">
<div class="row">
<!--div class="add-field" style="position: absolute;right: 0;">
<a href="member-form.php"><button type="button" class="btn btn-primary">Add New Field</button></a>
</div-->
<div class="col-lg-12 pb-5">
    <h2>ECS Tracking</h2>
    @if(count($ecs_list[1]) > 0)
    @if($ecs_list[0])
    <p>[Following Account Numbers are Not in Database; Allot them to respective Member using Membership Code]</p>
    <form action="{{ route('IgnoreECS') }}" method="post" onsubmit="return confirm('This will Ignore Selected ECS and It cannot be Undone.');">
    {{ csrf_field() }}
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>
                    <input id="sa_checkbox" type="checkbox">
                </th>
                <th>#</th>
                <th>Beneficiary AccNo</th>
                <th>Amount</th>
                <th>Status</th>
                <th>ECS File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($ecs_list[1] as $ecs)
            <tr>
            <td>
                <input type="checkbox" name="ecs_id[]" value="{{ $ecs->id }}">
            </td>
            <td><?php $i++; echo $i; ?></td>
            <td>{{$ecs->Beneficiary_AccNo}}</td>
            <td>{{$ecs->Amount}}</td>
            <td>{{$ecs->status}}</td>
            <td><a href="{{ asset('ecs/'.$ecs->pdf->transactions) }}" target="_blank">View PDF</a></td>
            <td>
                <a href="{{ route('ECS2MemberForm', ['id' => $ecs->id]) }}">Allot Membership Code</a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="algo" value="ecsid">
    <button type="submit" class="btn btn-danger">Ignore Selected ECS</button>
    </form>
    @else
    <p>[Following ECS are Untracked; Perform Membership Fees Process Here]</p>
    <script type="text/javascript">
        function submitForm(action) {
          var bool = confirm('This Action Cannot be Undone. Are you sure to continue?');
          if(bool) {
          var form = document.getElementById('ecs_tracking_form');
          form.action = action;
          form.submit();
        }}
    </script>
    <form id="ecs_tracking_form" action="" method="post">
    {{ csrf_field() }}
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>
                    <input id="sa_checkbox" type="checkbox">
                </th>
                <th>SNO</th>
                <th>Amount</th>
                <th>Member Name</th>
                <th>Membership Code</th>
                <th>ECS Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($ecs_list[1] as $ecs)
            <tr>
            <td>
                <input type="checkbox" name="ecs_id[]" value="{{ $ecs->id }}">
            </td>
            <td><?php $i++; echo $i;?></td>
            <td>{{$ecs->Amount}}</td>
            <td>{{$ecs->member_detail->name}}</td>
            <td>{{$ecs->member_detail->membership_code}}</td>
            <td>{{$ecs->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="algo" value="ecsid">
    </form>
    <button onclick="submitForm('{{ route('IgnoreECS') }}')" class="btn btn-danger">Ignore Selected ECS</button>
    <button onclick="submitForm('{{ route('MarkAsMembershipFees') }}')" class="btn btn-success">Selected ECS are Membership Fees</button>
    <br>
    <hr>
    <h2>Mass Allotment</h2>
    <hr>
    <h5>Membership Fees</h5>
    <form action="{{route('MarkAsMembershipFees')}}" method="post" style="padding-top:20px" onsubmit="return confirm('Process Mass Assignment?');">
        {{ csrf_field() }}
        <input type="hidden" name="algo" value="logic">
        <div class="row">
            <div class="col-md-3">
            <div class="form-group">
                <label class="active">Operator</label>
                <select  class="form-control" name="operator">
                    <option value="0" selected>Equals</option>
                </select>
            </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
                <label class="active">Amount</label>
                <input type="text" class="form-control" name="amount" value="1000" required>
            </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Membership Fees</button>
    </form>
    @endif
    @else
    <p>
        There are No Untracked ECS
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