@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
    <div class="add-field" style="position: absolute;right: 0;">
    <a href="{{ route('LHMembershipCollectionForm') }}"><button type="button" class="btn btn-primary">Add New Field</button></a>
    </div>
    <form action="{{route('LHMembershipCollectionView')}}" method="post" class="form-inline">
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
    <div class="col-lg-12 pb-5">
        <h2>MemberShip Fees Collection</h2>
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Membership Code</th>
                    <th>Amount</th>
                    <th>Cheque/Cash</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach($fees_ as $fees)
                <tr>
                    <th scope="row"><?php $i++; echo $i;?></th>
                    <td>{{ $fees->member_detail->name }}</td>
                    <td>{{ $fees->member_detail->membership_code }}</td>
                    <td>{{ $fees->paid_amount }}</td>
                    <td><?php
                    if($fees->pay_method == "CHEQUE") {
                        echo "CHEQUE<br>[ " .$fees->cheque_detail->number. " ]";
                    }
                    else
                    echo $fees->pay_method;
                    ?></td>
                    <td>{{ $fees->pay_date }}</td>
                    <td><a href="{{ route('LHMembershipCollectionForm', ['id' => $fees->id]) }}">Modify</a></td>
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
