@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
    <div class="add-field" style="position: absolute;right: 0;">
        <a href="{{ route('GetHelp') }}"><button type="button" class="btn btn-primary">New Help Form</button></a>
    </div>
    <div class="col-lg-12 pb-5">
        <br>
        <h2>Need Help</h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Request Date</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>HQ</th>
                    <th>Help</th>
                    <th>Request Letter</th>
                    <th>Offical Order</th>
                    <th>Status/Date</th>
                    @if(session('mode') != "member")
                    <th>Action</th>
                    @endif
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
                    <td>{{ $list_->help }}</td>
                    <td><a href="{{ asset('documents/'.$list_->request_letter) }}" target="_blank">View</a></td>
                    <td><a href="{{ asset('documents/'.$list_->official_order) }}" target="_blank">View</a></td>
                    <td>{{ $list_->status }}<br>[{{ date('d-F-Y', strtotime($list_->updated_at)) }}]</td>
                    @if(session('mode') != "member")
                    <td><?php if($list_->status == "Pending" || $list_->status == "Hold") { ?>
                        <a href="#" onclick="event.preventDefault();
                        document.getElementById('approve_form{{$list_->id}}').submit();">Approve</a> / <a href="#" onclick="event.preventDefault();
                        document.getElementById('decline_form{{$list_->id}}').submit();">Decline</a> / <a href="#" onclick="event.preventDefault();
                        document.getElementById('hold_form{{$list_->id}}').submit();">Hold</a>
                        <form id="approve_form{{$list_->id}}" action="{{ route('HelpAction') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="help_id" value="{{$list_->id}}">
                            <input type="hidden" name="status" value="Accepted">
                        </form>
                        <form id="decline_form{{$list_->id}}" action="{{ route('HelpAction') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="help_id" value="{{$list_->id}}">
                            <input type="hidden" name="status" value="Declined">
                        </form>
                        <form id="hold_form{{$list_->id}}" action="{{ route('HelpAction') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="help_id" value="{{$list_->id}}">
                            <input type="hidden" name="status" value="Hold">
                        </form>
                    <?php } else { ?>
                        by {{$list_->corecommittee_detail->name}}
                    <?php } ?></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection