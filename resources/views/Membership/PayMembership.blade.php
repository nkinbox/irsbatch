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
<div class="col-lg-12 pb-5">
    <h2>Pay Membership</h2>
    @if($bool)
    <div>Membership Fees Already PAID for this Month</div>
    @else
    <form action="{{route('PayMembership')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="table">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Memebership Code</td>
                        <td>{{ Auth::user()->membership_code }}</td>
                    </tr>
                    <tr>
                        <td>Payment Month</td>
                        <td>{{ date('F') }}</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>1000 INR</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="form-group">
                <label>Choose Pay Method</label>
                <select class="form-control" name="pay_method">
                    <option value="ONLINE"{{ (old('pay_method') == "ONLINE")?' selected':'' }}>ONLINE</option>
                    <option value="TRANSFER"{{ (old('pay_method') == "TRANSFER")?' selected':'' }}>Bank Deposit/Transfer</option>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Transaction Receipt (If Bank Deposit/Transfer)</label>
                <input type="file" name="receipt" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Proceed</button>
        </form>
    @endif
</div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection