@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">

<div class="row mb-4">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<!--div class="add-field" style="position: absolute;right: 0;">
<a href="member-form.php"><button type="button" class="btn btn-primary">Add New Field</button></a>
</div-->
<div class="col-lg-12 pb-5">
    <h2>ECS Tracking</h2>
    
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Membership Code</th>
                <th>HQ</th>
                <th>Phone Number</th>
                <th>WhatsApp No.</th>
                <th>PF No</th>
                <th>Designation</th>
                <th>Bank Name</th>
                <th>Nominee Name</th>
                <th>Nominee Phone No</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach($ecs_list[1] as $ecs) {
                echo "1";
            }
            ?>

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