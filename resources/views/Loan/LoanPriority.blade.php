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
                    <th>HQ</th>
                    <th>Loan Type</th>
                    <th>Loan Request(Amount)</th>
                    <th>No of Cheques Received</th>
                    <th>Date</th>
                    <th>Loan Form No</th>
                    <th>Loan Incharge</th>
                    <th>Cashier</th>
                    <th>Core Committee</th>
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
                    <td>{{ $loan->member_detail->hq }}</td>
                    <td>{{ $loan->loan_type }}</td>
                    <td>{{ $loan->amount }}</td>
                    <td>{{ count($loan->repayment_cheques) }}</td>
                    <td>{{ $loan->applied_on }}</td>
                    <td>{{ $loan->id }}</td>

                    <!-- working here -->
                    <td>
                        @if($loan->loan_incharge_id == null)
                        @if(session('mode') == 'president' || session('mode') == 'corecommittee')
                        <form action="{{ route('LoanSignature') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $loan->id }}">
                            <input type="hidden" name="sign_of" value="loan_incharge_signature">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        -
                        @endif
                        @else
                        <img src="{{ asset('signature/'.$loan->loan_incharge_signature) }}" style="width:100px">
                        <br>
                        ( {{ $loan->loan_incharge->name }} )
                        @endif
                    </td>
                    <td>
                        @if($loan->cashier_id == null)
                        @if(session('mode') == 'president' || session('mode') == 'corecommittee')
                        <form action="{{ route('LoanSignature') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $loan->id }}">
                            <input type="hidden" name="sign_of" value="cashier_signature">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        -
                        @endif
                        @else
                        <img src="{{ asset('signature/'.$member->cashier_signature) }}" style="width:100px">
                        <br>
                        ( {{ $loan->cashier->name }} )
                        @endif
                    </td>
                    <td>
                        @if($loan->corecommittee_id == null)
                        @if(session('mode') == 'president' || session('mode') == 'corecommittee')
                        <form action="{{ route('LoanSignature') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $loan->id }}">
                            <input type="hidden" name="sign_of" value="corecommittee_signature">
                            <input type="file" name="signature" required>
                            <button type="submit">Sign</button>
                        </form>
                        @else
                        -
                        @endif
                        @else
                        <img src="{{ asset('signature/'.$member->corecommittee_signature) }}" style="width:100px">
                        <br>
                        ( {{ $loan->corecommittee->name }} )
                        @endif
                    </td>

                    @if(session('mode') == 'president' || session('mode') == 'corecommittee')
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