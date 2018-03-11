@extends('Layout.app')
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
<div class="col-lg-12 pb-5">
    <h2>MemberShip Cancellation</h2>            
    <table class="table" id="table2" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Membership No</th>
                <th>Reason</th>                
                <th>Sign Of Member</th>
                <th>Request Letter</th>
                <th>Status</th>
                <th>Action</th>                
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($list as $list_)
            <tr>
                <th scope="row"><?php echo ++$i; ?></th>
                <td>{{ date('d-M-Y', strtotime($list_->created_at))}}</td>
                <td>{{ $list_->member_detail->name }}</td>
                <td>{{ $list_->member_detail->membership_code }}</td>
                <td><pre>{{ $list_->reason }}</pre></td>
                <td><img src="{{ asset('signature/'.$list_->signature) }}" style="width:100px"></td>
                <td><a href="{{ asset('documents/'.$list_->letter) }}" target="_blank">View</a></td>
                <td>{{ $list_->status }}</td>
                <td><?php if($list_->lobbyhead_detail == null) { ?>                
                    <a href="#" onclick="event.preventDefault();
                    document.getElementById('approve_form{{$list_->id}}').submit();">Approve</a> / <a href="#" onclick="event.preventDefault();
                    document.getElementById('decline_form{{$list_->id}}').submit();">Decline</a>
                    <form id="approve_form{{$list_->id}}" action="{{ route('CancellationStatus') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="cancel_id" value="{{$list_->id}}">
                        <input type="hidden" name="lobbyhead" value="1">
                        <input type="hidden" name="status" value="pending">
                    </form>
                    <form id="decline_form{{$list_->id}}" action="{{ route('CancellationStatus') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="cancel_id" value="{{$list_->id}}">
                        <input type="hidden" name="lobbyhead" value="1">
                        <input type="hidden" name="status" value="declined">
                    </form>
                <?php } else { ?>
                    <a href="#" onclick="event.preventDefault();
                    document.getElementById('approve_form{{$list_->id}}').submit();">Approve</a> / <a href="#" onclick="event.preventDefault();
                    document.getElementById('decline_form{{$list_->id}}').submit();">Decline</a> / <a href="#" onclick="event.preventDefault();
                    document.getElementById('hold_form{{$list_->id}}').submit();">Hold</a>
                    <form id="approve_form{{$list_->id}}" action="{{ route('CancellationStatus') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="cancel_id" value="{{$list_->id}}">
                        <input type="hidden" name="lobbyhead" value="0">
                        <input type="hidden" name="status" value="approved">
                    </form>
                    <form id="decline_form{{$list_->id}}" action="{{ route('CancellationStatus') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="cancel_id" value="{{$list_->id}}">
                        <input type="hidden" name="lobbyhead" value="0">
                        <input type="hidden" name="status" value="declined">
                    </form>
                    <form id="hold_form{{$list_->id}}" action="{{ route('CancellationStatus') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="cancel_id" value="{{$list_->id}}">
                        <input type="hidden" name="lobbyhead" value="0">
                        <input type="hidden" name="status" value="hold">
                    </form>
                <?php } ?>
                </td>
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