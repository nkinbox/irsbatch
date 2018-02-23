@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
<div class="row">
<div class="col-md-12">
<h1 style="text-align: center">Edit Nominee Details</h1>
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
            Nominee Details
        </p>
        <form  action="{{route('NomineeEdit')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nsalutation" class="active">Salutation</label>
                        <select id="nsalutation" name="nominee_salutation" class="form-control">
                            <option{{ (old('nominee_salutation', $nominee->nominee_salutation) == "Mr.") ? ' selected' : '' }}>Mr.</option>
                            <option{{ (old('nominee_salutation', $nominee->nominee_salutation) == "Ms.") ? ' selected' : '' }}>Ms.</option>
                            <option{{ (old('nominee_salutation', $nominee->nominee_salutation) == "Mrs.") ? ' selected' : '' }}>Mrs.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nominee_name" class="active">Nominee Name</label>
                        <input id="nominee_name" class="form-control" type="text" name="nominee_name" placeholder="nominee_name"  value="{{ old('nominee_name', $nominee->nominee_name) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                <label for="relationship" class="active">Relationship With Nominee</label>
                <input id="relationship" type="text" class="form-control" name="relationship" placeholder="relationship" value="{{ old('relationship', $nominee->relationship) }}">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <label for="phnominee" class="active">Phone No Nominee</label>
                <input id="phnominee" type="text" class="form-control" name="nominee_phone" placeholder="mobile_no" value="{{ old('nominee_phone', $nominee->nominee_phone) }}">
                </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>


            <div class="form-group">
                <label for="nAddress" class="active"> Nominee Address</label>
                <textarea rows="5" wrap="hard" id="nAddress" type="text" class="form-control" name="nominee_address" placeholder="nominee address">{{ old('nominee_address', $nominee->nominee_address) }}</textarea>
            </div>
            <br>
            <div class="row"><div class="col-md-3 col-md-offset-3"></div>
                <div class="col-md-3 ">
                    <img class="profile-pic1" style="position: absolute;" src="{{ asset('photograph/' . $nominee->nominee_photograph) }}" />
                    <div class="upload-button1">Affix Nominee<br> Recent Passport<br> Size Photograph</div>
                    <input name="nominee_photograph" class="file-upload1" type="file" accept="image/*"/>
                </div>
            </div>
            <!-- <hr style="border:3px solid #122f3b"> -->
            <br>
            <!--p class="lead" style="font-weight: bold">
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
            </div-->
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