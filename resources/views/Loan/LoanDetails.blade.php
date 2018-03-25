@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
    @if(session('mode') == "lobbyhead")
        <div class="add-field" style="position: absolute;right: 0;">
            <a href="{{ route('ChequeCollectionForm') }}"><button type="button" class="btn btn-primary">Collect Cheques</button></a>
        </div>
    @endif
    <div class="col-lg-12 pb-5">
        <h2>Loan Details</h2>
        
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $loan->member_detail->name }}</td>
                </tr>
                <tr>
                    <td>Membership Code</td>
                    <td>{{ $loan->member_detail->membership_code}}</td>
                </tr>
                <tr>
                    <td>HQ</td>
                    <td>{{ $loan->member_detail->hq }}</td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>{{ $loan->amount }}</td>
                </tr>
                <tr>
                    <td>Loan Type</td>
                    <td>{{ $loan->loan_type }}</td>
                </tr>
                <tr>
                    <td>Applied On</td>
                    <td>{{ $loan->applied_on }}</td>
                </tr>
                <tr>
                    <td>Sanctioned On</td>
                    <td>{{ $loan->sanction_on }}</td>
                </tr>
                <tr>
                    <td>Given On</td>
                    <td>{{ $loan->given_on }}</td>
                </tr>
                <tr>
                    <td>Repayment Cheques</td>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cheque Number</th>
                                    <th>Added Date</th>
                                    <th>Cheque Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach($loan->repayment_cheques as $cheque)
                            <tr>
                                <td>{{ $cheque->number }}</td>
                                <td>{{ $cheque->added_date }}</td>
                                <td>{{ $cheque->cheque_date }}</td>
                                <td>{{ (empty($cheque->status))?'Uncleared':'Cleared'}}</td>
                                <td>
                                    @if(empty($cheque->status))
                                        <a href="#" onclick="event.preventDefault();
                                        document.getElementById('approve_form{{$cheque->id}}').submit();">Mark Clear</a>
                                    <form id="approve_form{{$cheque->id}}" action="{{ route('LoanRepayment') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="cheque_id" value="{{$cheque->id}}">
                                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                        <td>Loan Cheques</td>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Cheque Number</th>
                                        <th>Added Date</th>
                                        <th>Cheque Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach($loan->loan_cheques as $cheque)
                                <tr>
                                    <td>{{ $cheque->number }}</td>
                                    <td>{{ $cheque->added_date }}</td>
                                    <td>{{ $cheque->cheque_date }}</td>
                                    <td>{{ (empty($cheque->status))?'Uncleared':'Cleared'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </td>
                    </tr>
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