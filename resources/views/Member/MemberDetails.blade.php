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
    <h2>Members Detail</h2>
    
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
            <?php $i = 0; ?>
            @foreach($members as $member)
            <tr>
                <td scope="row"><?php $i++; echo $i; ?></td>
                <td>{{ $member->salutation . ' ' . $member->name }}</td>
                <td>{{ $member->father_husband_name }}</td>
                <td>{{ $member->membership_code }}</td>
                <td>{{ $member->hq }}</td>
                <td>{{ $member->mobile_no }}</td>
                <td>{{ $member->whatsapp_no }}</td>
                <td>{{ $member->pf_no }}</td>
                <td>{{ $member->designation }}</td>
                <td>{{ $member->bank_name }}</td>
                <td>{{ $member->nominee_salutation . ' ' . $member->nominee_name }}</td>
                <td>{{ $member->nominee_phone }}</td>
                <td><a href="{{ route('ViewMember', ['id' => $member->id]) }}">View</a>/<a href="{{ route('EditMemberForm', ['id' => $member->id]) }}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $members->links() }}
</div>	
</div>
</div>
</div>
</div>
</div>
</main>
@endsection