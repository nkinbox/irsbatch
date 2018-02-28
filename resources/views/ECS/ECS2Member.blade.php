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
    <h2>Allot Member to ECS</h2>
    <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Beneficiary AccNo</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{$ecs->Beneficiary_AccNo}}</td>
                <td>{{$ecs->Amount}}</td>
                <td>{{$ecs->status}}</td>
                </tr>
            </tbody>
        </table>
        @if($member)
        <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Father/Husband Name</th>
                        <th>Membership Code</th>
                        <th>Bank Name</th>
                        <th>Bank Account No</th>
                        <th>Bank IFSC Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{$member->name}}</td>
                    <td>{{$member->father_husband_name}}</td>
                    <td>{{$member->membership_code}}</td>
                    <td>{{$member->bank_name}}</td>
                    <td>{{$member->acc_no}}</td>
                    <td>{{$member->ifsc_code}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
    <form  action="{{route('ECS2Member')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $ecs->id }}">
        <div class="form-group">
            <label for="member-code" class="active">Membership Code</label>
            <input id="member-code" type="text" class="form-control" name="membership_code" placeholder="Membership Code" value="{{ ($member)?($member->membership_code):'' }}" required>
        </div>
        @if($member)
        <input type="hidden" >
        <button type="submit" name="allot" value="1" class="btn btn-primary">Confirm Allot</button>
        <button type="submit" name="allot" value="0" class="btn btn-primary">Cancel Allot and Find Again</button>
        @else
        <input type="hidden" name="allot" value="0">
        <button type="submit" class="btn btn-primary">Allot</button>
        @endif
    </form>
</div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection