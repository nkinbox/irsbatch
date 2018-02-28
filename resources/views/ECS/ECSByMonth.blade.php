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
    <div class="add-field" style="position: absolute;right: 0;">
        <a href="{{ route('UploadEcsForm') }}"><button type="button" class="btn btn-primary">Add New File</button></a>
    </div>
    <div class="col-lg-12 pb-5">
        <br>
        <h2>ECS Details Month Wise</h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date of File</th>
                    <th>ECS File (All Transactions)</th>
                    <th>ECS File (Returned Transactions)</th>
                    <th>ECS File (Rejected Transactions)</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach($ecs as $ecs_)
                <tr>
                    <th scope="row"><?php $i++; echo $i;?></th>
                    <td>{{ date('M-Y', strtotime('01-'.$ecs_->ecs_month.'-'.$ecs_->ecs_year)) }}</td>
                    <td>
                        @if($ecs_->transactions)
                        <a href="{{ asset('ecs/'.$ecs_->transactions) }}" target="_blank">View</a>
                        @else
                        NA
                        @endif
                    </td>
                    <td>
                        @if($ecs_->returned)
                        <a href="{{ asset('ecs/'.$ecs_->returned) }}" target="_blank">View</a>
                        @else
                        NA
                        @endif
                    </td>
                    <td>
                        @if($ecs_->rejected)
                        <a href="{{ asset('ecs/'.$ecs_->rejected) }}" target="_blank">View</a>
                        @else
                        NA
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ecs->links() }}
    </div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection