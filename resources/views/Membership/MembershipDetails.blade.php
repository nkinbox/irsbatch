@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<!-- <div class="col-md-12">
<h1>Tables</h1>
</div> -->
</div>
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-12 pb-5">
    <h2>Membership Detail</h2>
    <form action="{{route('MembershipDetails')}}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
            <select name="month" class="form-control">
                <option>Month</option>
                <option value="01"{{ ($month == "01")?' selected':''}}>January</option>
                <option value="02"{{ ($month == "02")?' selected':''}}>February</option>
                <option value="03"{{ ($month == "03")?' selected':''}}>March</option>
                <option value="04"{{ ($month == "04")?' selected':''}}>April</option>
                <option value="05"{{ ($month == "05")?' selected':''}}>May</option>
                <option value="06"{{ ($month == "06")?' selected':''}}>June</option>
                <option value="07"{{ ($month == "07")?' selected':''}}>July</option>
                <option value="08"{{ ($month == "08")?' selected':''}}>August</option>
                <option value="09"{{ ($month == "09")?' selected':''}}>September</option>
                <option value="10"{{ ($month == "10")?' selected':''}}>October</option>
                <option value="11"{{ ($month == "11")?' selected':''}}>November</option>
                <option value="12"{{ ($month == "12")?' selected':''}}>December</option>
            </select>
            </div>
            <div class="form-group">
            <select name="year" class="form-control">
                <option>Year</option>
                <?php $y = date('Y');?>
                @for($i = $y; $i > ($y - 5); $i--)
                <option{{ ($year == $i)?' selected':''}}>{{$i}}</option>
                @endfor
            </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    <table class="table" id="example" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Membership No</th>
                <th>HQ</th>	
                <th>Payment Date</th>
                <th>Amount</th>
                <th>Fine(If Any)</th>
                <th>Payment Mode</th>
                <th>Paid Amount</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($members as $member)
            <tr>
                <td scope="row"><?php $i++; echo $i;?></td>
                <td>{{$member->name}}</td>
                <td>{{$member->membership_code}}</td>
                <td>{{$member->hq}}</td>
                <td>{{(!$member->membership_fees->isEmpty())?$member->membership_fees[0]->pay_date:'-'}}</td>
                <td>{{(!$member->membership_fees->isEmpty())?$member->membership_fees[0]->fees_amount:'-'}}</td>
                <td>{{(!$member->membership_fees->isEmpty())?$member->membership_fees[0]->fine_amount:'-'}}</td>
                <td>
                <?php
                if(!$member->membership_fees->isEmpty()) {
                    if($member->membership_fees[0]->pay_method == "CASH")
                    echo $member->membership_fees[0]->pay_method. "<br>(" .$member->membership_fees[0]->paid_to->name. ")";
                    elseif($member->membership_fees[0]->pay_method == "TRANSFER")
                    echo $member->membership_fees[0]->pay_method. "<br>(<a href='" .asset('receipts/'.$member->membership_fees[0]->receipt_file). "' target='_blank'>Receipt</a>)";
                    else
                    echo $member->membership_fees[0]->pay_method;
                } else {
                    echo "-";
                }
                ?>
                </td>
                <td>{{(!$member->membership_fees->isEmpty())?$member->membership_fees[0]->paid_amount:'-'}}</td>
                <td>
                <?php
                if(!$member->membership_fees->isEmpty()) {
                    if($member->membership_fees[0]->status == "CASH") //working on this line cash == success
                    echo $member->membership_fees[0]->pay_method. "<br>(" .$member->membership_fees[0]->paid_to->name. ")";
                    elseif($member->membership_fees[0]->pay_method == "TRANSFER")
                    echo $member->membership_fees[0]->pay_method. "<br>(<a href='" .asset('receipts/'.$member->membership_fees[0]->receipt_file). "' target='_blank'>Receipt</a>)";
                    else
                    echo $member->membership_fees[0]->pay_method;
                } else {
                    echo "-";
                }
                ?>
                </td>
                <td>{{(!$member->membership_fees->isEmpty())?$member->membership_fees[0]->status:'-'}}</td>
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
