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
        <form  action="{{route('SignUp')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="salutation" class="active">Salutation</label>
                    <select id="salutation" name="salutation" class="form-control">
                        <option{{ (old('salutation') == "Mr.") ? ' selected' : '' }}>Mr.</option>
                        <option{{ (old('salutation') == "Ms.") ? ' selected' : '' }}>Ms.</option>
                        <option{{ (old('salutation') == "Mrs.") ? ' selected' : '' }}>Mrs.</option>
                    </select>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="name" class="active">Full Name</label>
                    <input id="name" class="form-control" type="text" name="name" placeholder="Full Name"  value="{{ old('name') }}">
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="fhname" class="active">Father / Husband Name</label>
                <input id="fhname" type="text" class="form-control" name="father_husband_name" placeholder="Father or Husband name" value="{{ old('father_husband_name') }}">
            </div>
            <!--div class="form-group">
                <label for="email" class="active">EmailID</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}">
            </div-->
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="designation" class="active">Designation</label>
                <input id="designation" type="text"  class="form-control" name="designation" placeholder="designation" value="{{ old('designation') }}">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="hq" class="active">HQ</label>
                <input id="hq" type="text" class="form-control" name="hq" placeholder="hq" value="{{ old('hq') }}">
            </div>
            </div>
            </div>

            <div class="form-group">
                <label for="Address" class="active">Current Address</label>
                <textarea rows="5" wrap="hard" id="Address" type="text" class="form-control" name="address" placeholder="current_address">{{ old('address') }}</textarea>
            </div>

            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label for="dob" class="active">D.O.B</label>
                <input id="dob" type="date" class="form-control" name="dob" placeholder="dob" value="{{ old('dob') }}">
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="doa" class="active">D.O.A</label>
                <input id="doa" type="date" class="form-control" name="doa" placeholder="doa" value="{{ old('doa') }}">
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label for="dor" class="active">D.O.R</label>
                <input id="dor" type="date" class="form-control" name="dor" placeholder="dor" value="{{ old('dor') }}">
            </div>
            </div>
            </div>

            <div class="form-group">
                <label for="PAddress" class="active">Permanent Address</label>
                <textarea rows="5" wrap="hard" id="PAddress" type="text" class="form-control" name="permanent_address" placeholder="permanent_address">{{ old('permanent_address') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile" class="active">Mobile Number</label>
                    <input id="mobile" type="text" class="form-control" name="mobile_no" placeholder="mobile_no" value="{{ old('mobile_no') }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="whatsapp_no" class="active">WhatsApp Mobile Number</label>
                    <input id="whatsapp_no" type="text" class="form-control" name="whatsapp_no" placeholder="whatsapp_no" value="{{ old('whatsapp_no') }}">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                <label for="bankac" class="active">Bank A/c Number</label>
                <input id="bankac" type="text" class="form-control" name="acc_no" placeholder="Acc Number" value="{{ old('acc_no') }}">
            </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                <label for="bankifsc" class="active">IFSC Code</label>
                <input id="bankifsc" type="text" class="form-control" name="ifsc_code" placeholder="ifsc_code"  value="{{ old('ifsc_code') }}">
            </div>
                </div>
            </div>

            <div class="form-group">
                <label for="bankname" class="active">Bank Name</label>
                <input id="bankname" type="text" class="form-control" name="bank_name" placeholder="bank_name" value="{{ old('bank_name') }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="branch" class="active">Branch Name</label>
                <input id="branch" type="text" class="form-control" name="branch_name" placeholder="branch_name" value="{{ old('branch_name') }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="pan" class="active">PAN Card Number</label>
                <input id="pan" type="text" class="form-control" name="pan_card" placeholder="pancard_no" value="{{ old('pan_card') }}">
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="vid" class="active">Voter / Aadhar Id No</label>
                <input id="vid" type="text" class="form-control" name="id_number" placeholder="ID Number" value="{{ old('id_number') }}">
                </div>
                </div>
                <div class="col-md-6">
                    <!--div class="form-group">
                    <label for="ano" class="active">Aadhar No</label>
                    <input id="ano" type="text" class="form-control" name="aadhar_no" placeholder="aadhar_no" value="{{ old('aadhar_no') }}">
                    </div-->
                    <div class="form-group">
                        <label for="rid" class="active">Railway Id No</label>
                        <input id="rid" type="text" class="form-control" name="railway_id" placeholder="railway_id" value="{{ old('railway_id') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="Introduce" class="active">Introducer Membership Number</label>
                <input id="Introduce" type="text" class="form-control" name="introduce_no" placeholder="Introducer Membership Number" value="{{ old('introduce_no') }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="pfno" class="active">P.F. No</label>
                <input id="pfno" type="text" class="form-control" name="pf_no" placeholder="pf_no" value="{{ old('pf_no') }}">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bloodgroup" class="active">Blood Group</label>
                        <select id="bloodgroup" name="blood_group" class="form-control">
                            <option value="0"{{ (old('blood_group') == "0") ? ' selected' : '' }}>A+</option>
                            <option value="1"{{ (old('blood_group') == "1") ? ' selected' : '' }}>A-</option>
                            <option value="2"{{ (old('blood_group') == "2") ? ' selected' : '' }}>B+</option>
                            <option value="3"{{ (old('blood_group') == "3") ? ' selected' : '' }}>B-</option>
                            <option value="4"{{ (old('blood_group') == "4") ? ' selected' : '' }}>O+</option>
                            <option value="5"{{ (old('blood_group') == "5") ? ' selected' : '' }}>O-</option>
                            <option value="6"{{ (old('blood_group') == "6") ? ' selected' : '' }}>AB+</option>
                            <option value="7"{{ (old('blood_group') == "7") ? ' selected' : '' }}>AB-</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <hr style="border:1px solid #122f3b">
            <p class="lead" style="font-weight: bold">
            Cheque Details
            </p>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="chequeno" class="active">Cheque Number</label>
                <input id="chequeno" type="text" class="form-control" name="admission_cheque" placeholder="Admission Cheque Number" value="{{ old('admission_cheque') }}">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="chqamno" class="active">Amount</label>
                <input id="chqamno" type="text" class="form-control" name="cheque_amount" placeholder="cheque_amount" value="{{ old('cheque_amount', '1000') }}">
                </div>
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
                            <option{{ (old('nominee_salutation') == "Mr.") ? ' selected' : '' }}>Mr.</option>
                            <option{{ (old('nominee_salutation') == "Ms.") ? ' selected' : '' }}>Ms.</option>
                            <option{{ (old('nominee_salutation') == "Mrs.") ? ' selected' : '' }}>Mrs.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nominee_name" class="active">Nominee Name</label>
                        <input id="nominee_name" class="form-control" type="text" name="nominee_name" placeholder="nominee_name"  value="{{ old('nominee_name') }}">
                    </div>
                </div>
                <!--div class="col-md-5">
                    <div class="form-group">
                        <label for="nlast_name" class="active">Nominee Last Name</label>
                        <input id="nlast_name" type="text" name="nlast_name" class="form-control" placeholder="last_name" value="{{ old('nlast_name') }}">
                    </div>
                </div-->
            </div>
            <!--div class="form-group">
                <label for="nemail" class="active">Nominee EmailID</label>
                <input id="nemail" type="email" class="form-control" name="nemail" placeholder="email" value="{{ old('nemail') }}">
            </div-->
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                <label for="relationship" class="active">Relationship With Nominee</label>
                <input id="relationship" type="text" class="form-control" name="relationship" placeholder="relationship" value="{{ old('relationship') }}">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <label for="phnominee" class="active">Phone No Nominee</label>
                <input id="phnominee" type="text" class="form-control" name="nominee_phone" placeholder="mobile_no" value="{{ old('nominee_phone') }}">
                </div>
                </div>
                <div class="col-md-4">
                <!--div class="form-group">
                <label for="altphnominee" class="active">Alt. Phone No Nominee</label>
                <input id="altphnominee" type="text" class="form-control" name="naltmobile_no" placeholder="mobile_no" value="{{ old('naltmobile_no') }}">
                </div-->
                </div>
            </div>
            <!--div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankac" class="active">Bank A/c Number</label>
                <input id="nominee_bankac" type="text" class="form-control" name="nominee_acc_no" placeholder="Acc Number" value="{{ old('nominee_acc_no') }}">
            </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                <label for="nominee_bankifsc" class="active">IFSC Code</label>
                <input id="nominee_bankifsc" type="text" class="form-control" name="nominee_ifsc_code" placeholder="ifsc_code"  value="{{ old('nominee_ifsc_code') }}">
            </div>
                </div>
            </div-->



            <!--div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="nominee_bankname" class="active">Bank Name</label>
                        <input id="nominee_bankname" type="text" class="form-control" name="nominee_bank_name" placeholder="bank_name" value="{{ old('nominee_bank_name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="nominee_branch" class="active">Branch Name</label>
                <input id="nominee_branch" type="text" class="form-control" name="nominee_branch_name" placeholder="branch_name" value="{{ old('nominee_branch_name') }}">
                </div>
                </div>
            </div-->

            <div class="form-group">
                <label for="nAddress" class="active"> Nominee Address</label>
                <textarea rows="5" wrap="hard" id="nAddress" type="text" class="form-control" name="nominee_address" placeholder="nominee address">{{ old('nominee_address') }}</textarea>
            </div>
            <br>
            <div class="row"><div class="col-md-3 col-md-offset-3"></div>
                <div class="col-md-3 ">
                    <img class="profile-pic" style="position: absolute;" src="" />
                    <div class="upload-button">Affix Applicant<br> Recent Passport<br> Size Photograph</div>
                    <input name="photograph" class="file-upload" type="file" accept="image/*"/>
                </div>
                <div class="col-md-3 ">
                    <img class="profile-pic1" style="position: absolute;" src="" />
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
                <div class="col-md-3" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Document Name</label>
                    <input type="text"  class="form-control" name="docs_name[0]" placeholder="Document Name" value="voter ID / Aadhar card" readonly>
                    <input type="file"  class="form-control" name="docs[0][]" multiple required>
                </div>
                </div>
                <div class="col-md-3" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Document Name</label>
                    <input type="text"  class="form-control" name="docs_name[1]" placeholder="Document Name" value="Railways ID card" readonly>
                    <input type="file"  class="form-control" name="docs[1][]" multiple required>
                </div>
                </div>
                <div class="col-md-3" style="padding-top:2em">
                <div class="form-group">
                    <label class="active">Document Name</label>
                    <input type="text"  class="form-control" name="docs_name[2]" placeholder="Document Name" value="PAN Card" readonly>
                    <input type="file"  class="form-control" name="docs[2][]" multiple required>
                </div>
                </div>
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