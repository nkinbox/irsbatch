@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1>Tables</h1>
</div>
</div>
<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<!-- <div class="add-field" style="position: absolute;right: 0;">
<a href="ecs.php"><button type="button" class="btn btn-primary">Add New Field</button></a>
</div> -->
<div class="col-lg-12 pb-5">
    <h2>ECS Table</h2>
    
    <table class="table table-responsive" id="example" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Membership no</th>
                <th>Phone</th>
                <th>Bank Name</th>
                <th>IFSC Code</th>
                <th>Account Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td >1</td>
                <td>deepak</td>
                <td>34235345</td>
                <td>8527439091</td>
                <td>state bank of india</td>
                <td>dfsdfsdf</td>
                <td>45345435435345</td>
                <td><a href="#">View</a></td>

            </tr>
            <tr>
                <td >2</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td><a href="#">View</a></td>
            </tr>
            <tr>
                <td >2</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td>Table cell</td>
                <td><a href="#">View</a></td>
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