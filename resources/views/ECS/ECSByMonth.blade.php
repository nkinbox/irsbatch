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
        <h2>ECS Details Month Wise</h2>
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date of File</th>
                    <th>ECS File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach($ecs as $ecs_)
                <tr>
                    <th scope="row"><?php $i++; echo $i;?></th>
                    <td>{{ date('M-Y', strtotime('01-'.$ecs_->ecs_month.'-'.$ecs_->ecs_year)) }}</td>
                    <td>34235345</td>
                    <td><a href="#">View</a></td>
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