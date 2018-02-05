@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-12 pb-5">
            <h2>Admission Approval</h2>
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @if(count($members) > 0)
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name Of Member</th>
                        <th>Father/Husband Name</th>
                        <th>Designation</th>
                        <th>Hq</th>
                        <th>Railway Id</th>
                        <th>Applied On</th>
                        <th>Cheque No</th>
                        <th>MemberShip NO</th>
                        <th>ADM Incharge</th>
                        <th>Cashier </th>
                        <th>VP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach($members as $member)
                    <tr>
                        <th scope="row"><?php $i++; echo $i;?></th>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->father_husband_name }}</td>
                        <td>{{ $member->designation }}</td>
                        <td>{{ $member->hq }}</td>
                        <td>{{ $member->railway_id }}</td>
                        <td>{{ $member->applied_on}}</td>
                        <td>Cheque No</td>
                        <td><code>{{ $membership_code }}</code></td>
                        <td>
                            @if($member->adm_incharge == null)
                            <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <input type="hidden" name="sign_of" value="adm_incharge">
                                <input type="file" name="signature" required>
                                <button type="submit">Sign</button>
                            </form>
                            @else
                            <img src="{{ asset('signature/'.$member->adm_incharge) }}" style="width:100px">
                            @endif
                        </td>
                        <td>
                            @if($member->cashier == null)
                            <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <input type="hidden" name="sign_of" value="cashier">
                                <input type="file" name="signature" required>
                                <button type="submit">Sign</button>
                            </form>
                            @else
                            <img src="{{ asset('signature/'.$member->cashier) }}" style="width:100px">
                            @endif
                        </td>
                        <td>
                            @if($member->vice_president == null)
                            <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <input type="hidden" name="sign_of" value="vice_president">
                                <input type="file" name="signature" required>
                                <button type="submit">Sign</button>
                            </form>
                            @else
                            <img src="{{ asset('signature/'.$member->vice_president) }}" style="width:100px">
                            @endif
                        </td>
                        <td>
                            <form id="accept{{ $member->id }}" action="{{ route('ApplicationStatus') }}" method="post" style="display:none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <input type="hidden" name="status" value="accepted">
                            </form>
                            <form id="reject{{ $member->id }}" action="{{ route('ApplicationStatus') }}" method="post" style="display:none">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $member->id }}">
                                    <input type="hidden" name="status" value="rejected">
                                </form>
                            <a href="{{ route('ShowApplication', $member->id) }}" target="_blank">View</a>/
                            <a href="#" onclick="document.getElementById('accept{{ $member->id }}').submit();">Approve</a>/
                            <a href="#" onclick="document.getElementById('reject{{ $member->id }}').submit();">Reject</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div>No Pending Applications</div>
            @endif
        </div>	
    </div>
</div>
</div>
</div>
</div>
</main>
@endsection