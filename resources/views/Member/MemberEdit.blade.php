@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Admission Form</h1>
</div>
</div>
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
    <div class="col-lg-12">
        <p class="lead" style="font-weight: bold">
            Member Details
        </p>
        <form  action="{{route('EditMember')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$member->id}}">
            <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="salutation" class="active">Salutation</label>
                    <select id="salutation" name="salutation" class="form-control"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                        <option{{ (old('salutation', $member->salutation) == "Mr.") ? ' selected' : '' }}>Mr.</option>
                        <option{{ (old('salutation', $member->salutation) == "Ms.") ? ' selected' : '' }}>Ms.</option>
                        <option{{ (old('salutation', $member->salutation) == "Mrs.") ? ' selected' : '' }}>Mrs.</option>
                    </select>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="name" class="active">Full Name</label>
                    <input id="name" class="form-control" type="text" name="name" placeholder="Full Name"  value="{{ old('name', $member->name) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="fhname" class="active">Father / Husband Name</label>
                <input id="fhname" type="text" class="form-control" name="father_husband_name" placeholder="Father or Husband name" value="{{ old('father_husband_name', $member->father_husband_name) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="designation" class="active">Designation</label>
                <input id="designation" type="text"  class="form-control" name="designation" placeholder="designation" value="{{ old('designation', $member->designation) }}">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="hq" class="active">HQ</label>
                <input id="hq" type="text" class="form-control" name="hq" placeholder="hq" value="{{ old('hq', $member->hq) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
            </div>
            </div>
            </div>

            <div class="form-group">
                <label for="Address" class="active">Current Address</label>
                <textarea rows="5" wrap="hard" id="Address" type="text" class="form-control" name="address" placeholder="current_address">{{ old('address', $member->address) }}</textarea>
            </div>

            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label for="dob" class="active">D.O.B</label>
                <input id="dob" type="date" class="form-control" name="dob" placeholder="dob" value="{{ old('dob', $member->dob) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="doa" class="active">D.O.A</label>
                <input id="doa" type="date" class="form-control" name="doa" placeholder="doa" value="{{ old('doa', $member->doa) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="dor" class="active">D.O.R</label>
                <input id="dor" type="date" class="form-control" name="dor" placeholder="dor" value="{{ old('dor', $member->dor) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
            </div>
            </div>
            </div>

            <div class="form-group">
                <label for="PAddress" class="active">Permanent Address</label>
                <textarea rows="5" wrap="hard" id="PAddress" type="text" class="form-control" name="permanent_address" placeholder="permanent_address"{{(session('mode') == 'lobbyhead')?' readonly':''}}>{{ old('permanent_address', $member->permanent_address) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile" class="active">Mobile Number</label>
                    <input id="mobile" type="text" class="form-control" name="mobile_no" placeholder="mobile_no" value="{{ old('mobile_no', $member->mobile_no) }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="whatsapp_no" class="active">WhatsApp Mobile Number</label>
                    <input id="whatsapp_no" type="text" class="form-control" name="whatsapp_no" placeholder="whatsapp_no" value="{{ old('whatsapp_no', $member->whatsapp_no) }}">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                <label for="bankac" class="active">Bank A/c Number</label>
                <input id="bankac" type="text" class="form-control" name="acc_no" placeholder="Acc Number" value="{{ old('acc_no', $member->acc_no) }}">
            </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                <label for="bankifsc" class="active">IFSC Code</label>
                <input id="bankifsc" type="text" class="form-control" name="ifsc_code" placeholder="ifsc_code"  value="{{ old('ifsc_code', $member->ifsc_code) }}">
            </div>
                </div>
            </div>

            <div class="form-group">
                <label for="bankname" class="active">Bank Name</label>
                <input id="bankname" type="text" class="form-control" name="bank_name" placeholder="bank_name" value="{{ old('bank_name', $member->bank_name) }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="branch" class="active">Branch Name</label>
                <input id="branch" type="text" class="form-control" name="branch_name" placeholder="branch_name" value="{{ old('branch_name', $member->branch_name) }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="pan" class="active">PAN Card Number</label>
                <input id="pan" type="text" class="form-control" name="pan_card" placeholder="pancard_no" value="{{ old('pan_card', $member->pan_card) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="vid" class="active">Voter / Aadhar Id No</label>
                <input id="vid" type="text" class="form-control" name="id_number" placeholder="ID Number" value="{{ old('id_number', $member->id_number) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rid" class="active">Railway Id No</label>
                        <input id="rid" type="text" class="form-control" name="railway_id" placeholder="railway_id" value="{{ old('railway_id', $member->railway_id) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="pfno" class="active">P.F. No</label>
                <input id="pfno" type="text" class="form-control" name="pf_no" placeholder="pf_no" value="{{ old('pf_no', $member->pf_no) }}"{{(session('mode') == 'lobbyhead')?' readonly':''}}>
                </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>

            <hr style="border:1px solid #122f3b">
            <p class="lead" style="font-weight: bold">
            Nominee Details
            </p>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nsalutation" class="active">Salutation</label>
                        <select id="nsalutation" name="nominee_salutation" class="form-control">
                            <option{{ (old('nominee_salutation', $member->nominee_salutation) == "Mr.") ? ' selected' : '' }}>Mr.</option>
                            <option{{ (old('nominee_salutation', $member->nominee_salutation) == "Ms.") ? ' selected' : '' }}>Ms.</option>
                            <option{{ (old('nominee_salutation', $member->nominee_salutation) == "Mrs.") ? ' selected' : '' }}>Mrs.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nominee_name" class="active">Nominee Name</label>
                        <input id="nominee_name" class="form-control" type="text" name="nominee_name" placeholder="nominee_name"  value="{{ old('nominee_name', $member->nominee_name) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                <label for="relationship" class="active">Relationship With Nominee</label>
                <input id="relationship" type="text" class="form-control" name="relationship" placeholder="relationship" value="{{ old('relationship', $member->relationship) }}">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <label for="phnominee" class="active">Phone No Nominee</label>
                <input id="phnominee" type="text" class="form-control" name="nominee_phone" placeholder="mobile_no" value="{{ old('nominee_phone', $member->nominee_phone) }}">
                </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankac" class="active">Bank A/c Number</label>
                <input id="nominee_bankac" type="text" class="form-control" name="nominee_acc_no" placeholder="Acc Number" value="{{ old('nominee_acc_no', $member->nominee_acc_no) }}">
            </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankifsc" class="active">IFSC Code</label>
                <input id="nominee_bankifsc" type="text" class="form-control" name="nominee_ifsc_code" placeholder="ifsc_code"  value="{{ old('nominee_ifsc_code', $member->nominee_ifsc_code) }}">
            </div>
                </div>
            </div>



            <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="nominee_bankname" class="active">Bank Name</label>
                        <input id="nominee_bankname" type="text" class="form-control" name="nominee_bank_name" placeholder="bank_name" value="{{ old('nominee_bank_name', $member->nominee_bank_name) }}">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="nominee_branch" class="active">Branch Name</label>
                <input id="nominee_branch" type="text" class="form-control" name="nominee_branch_name" placeholder="branch_name" value="{{ old('nominee_branch_name', $member->nominee_branch_name) }}">
                </div>
                </div>
            </div>

            <div class="form-group">
                <label for="nAddress" class="active"> Nominee Address</label>
                <textarea rows="5" wrap="hard" id="nAddress" type="text" class="form-control" name="nominee_address" placeholder="nominee address">{{ old('nominee_address', $member->nominee_address) }}</textarea>
            </div>
            <br>
            <div class="row"><div class="col-md-3 col-md-offset-3"></div>
                <div class="col-md-3 ">
                    <img class="profile-pic" style="position: absolute;" src="{{ asset('photograph/' . $member->photograph) }}" />
                    <div class="upload-button">Affix Applicant<br> Recent Passport<br> Size Photograph</div>
                    <input name="photograph" class="file-upload" type="file" accept="image/*"/>
                </div>
                <div class="col-md-3 ">
                    <img class="profile-pic1" style="position: absolute;" src="{{ asset('photograph/' . $member->nominee_photograph) }}" />
                    <div class="upload-button1">Affix Nominee<br> Recent Passport<br> Size Photograph</div>
                    <input name="nominee_photograph" class="file-upload1" type="file" accept="image/*"/>
                </div>
            </div>
            <!-- <hr style="border:3px solid #122f3b"> -->
            <br>
            <p class="lead" style="font-weight: bold">
            Upload Documents
            </p>
            <a href="#" class="btn btn-default" id="addNewDoc">Add New Document</a>
            <div class="row" id="docsContainer">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>

</main>

@endsection