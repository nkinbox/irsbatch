@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
        <div class="add-field" style="position: absolute;right: 0;">
            <a href="{{ route('ChequeCollectionForm') }}"><button type="button" class="btn btn-primary">Collect Cheques</button></a>
        </div>
    <div class="col-lg-12 pb-5">
        <h2>Loan Request</h2>
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>Loan Request(Amount)</th>
                    <th>No of Cheques Received</th>
                    <th>Date</th>
                    <th>Loan Form No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
            @foreach($loans as $loan)
                <tr>
                    <th scope="row"><?php echo ++$i; ?></th>
                    <td>{{ $loan->member_detail->name }}</td>
                    <td>{{ $loan->member_detail->membership_code }}</td>
                    <td>{{ $loan->amount }}</td>
                    <td>{{ count($loan->repayment_cheques) }}</td>
                    <td>{{ $loan->applied_on }}</td>
                    <td>{{ $loan->id }}</td>

                    <!-- working here -->
                    <td>
                        @if($loan->loan_incharge_id == null)
                        <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $loan->id }}">
                            <input type="hidden" name="sign_of" value="loan_incharge_signature">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        <img src="{{ asset('signature/'.$loan->loan_incharge_signature) }}" style="width:100px">
                        @endif
                    </td>
                    <td>
                        @if($loan->cashier_id == null)
                        <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $loan->id }}">
                            <input type="hidden" name="sign_of" value="cashier_signature">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        <img src="{{ asset('signature/'.$member->cashier_signature) }}" style="width:100px">
                        @endif
                    </td>
                    <td>
                        @if($loan->president_id == null)
                        <form action="{{ route('SignatureUpload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $member->id }}">
                            <input type="hidden" name="sign_of" value="cashier">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        <img src="{{ asset('signature/'.$member->president_signature) }}" style="width:100px">
                        @endif
                    </td>

                    @if(session('mode') == 'president')
                    <td><a href="#" onclick="event.preventDefault();
                        document.getElementById('approve_form{{$loan->id}}').submit();">Approve</a> / <a href="#" onclick="event.preventDefault();
                        document.getElementById('decline_form{{$loan->id}}').submit();">Decline</a></td>
                    <form id="approve_form{{$loan->id}}" action="{{ route('LoanPriority') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="status" value="Priority">
                    </form>
                    <form id="decline_form{{$loan->id}}" action="{{ route('LoanPriority') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                        <input type="hidden" name="status" value="Rejected">
                    </form>
                    @endif
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