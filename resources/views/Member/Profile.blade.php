@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
        <div class="row">
        </div>
        <div class="row mb-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                  <div class="col-lg-12 pb-5">
                    @if(!empty($member))
                    @if(request()->route()->getName() == "ShowApplication")
                    <h2 style="float:right"><small>applied: </small>{{date('d-M-y', strtotime($member->applied_on))}}</h2>
                    @else
                    <h2 style="float:right"><small>Joined: </small>{{date('d-M-y', strtotime($member->approved_on))}}</h2>
                    @endif
                    <h2>{{$member->salutation. ' ' .$member->name }}</h2>
                    <div class="row">
                      <div class="col-md-4">
                        <img src="{{ asset('photograph/' . $member->photograph) }}" style="width:100px">
                        <br>
                        @if(!$member->membership)
                        <div><code>Membership INACTIVE</code></div>
                        @else
                        <h5>{{ ($member->position_id == 0)?'Member':$member->position->position }}</h5>
                        <h6>{{$member->membership_code}}</h6>
                        @if($member->introduced_by)
                        <div><br>                         
                          Introduced By: {{$member->introduced_by->name}}
                        </div>
                        @endif
                        @endif
                      </div>
                      <div class="col-md-8">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>{{$member->salutation. ' ' .$member->name}}</td>
                              <td>({{$member->designation}})</td>
                              <td>{{$member->hq}}</td>
                            </tr>
                            <tr>
                              <td><b>Father/Husband:</b> {{$member->father_husband_name}}</td>
                              <td></td>
                              <td><b>BloodGroup:</b> {{ $member->blood_group }}</td>
                            </tr>
                            <tr>
                              <td><b>RailwayId:</b> {{$member->railway_id}}</td>
                              <td><b>VoterId/Aadhar:</b> {{$member->id_number}}</td>
                              <td><b>PAN:</b> {{$member->pan_card}}</td>
                            </tr>
                            <tr>
                              <td><b>Mob:</b> {{$member->mobile_no}}</td>
                              <td><b>WApp:</b> {{$member->whatsapp_no}}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><b>PF:</b> {{$member->pf_no}}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><b>DOB:</b> {{date('d-M-y',strtotime($member->dob))}}</td>
                              <td><b>DOA:</b> {{date('d-M-y',strtotime($member->doa))}}</td>
                              <td><b>DOR:</b> {{date('d-M-y',strtotime($member->dor))}}</td>
                            </tr>
                            <tr>
                              <td><b>Current Address:</b> <pre>{{$member->address}}</pre></td>
                            </tr>
                            <tr>
                              <td><b>Permanent Address:</b> <pre>{{$member->permanent_address}}</pre></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                      <a href="{{ route('ProfileEditForm') }}" class="btn btn-primary">Edit</a>
                      </div>
                    </div>
                    <hr>
                    <h2>Nominee Details</h2>
                    <div>
                      <div class="col-md-4">
                        <img src="{{ asset('photograph/' . $member->nominee_photograph) }}" style="width:100px">
                      </div>
                      <div class="col-md-8">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>{{$member->nominee_salutation . ' ' . $member->nominee_name}}</td>
                              <td>{{$member->relationship}}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>{{$member->nominee_phone}}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><pre>{{$member->nominee_address}}</pre></td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                          <a href="{{ route('NomineeEditForm') }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                    <hr>
                    <h2>Bank Details</h2>
                    <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Member</th>
                          <th>Nominee</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Account Number</td>
                          <td>{{ $member->acc_no }}</td>
                          <td>{{ $member->nominee_acc_no }}</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>{{ $member->bank_name }}</td>
                            <td>{{ $member->nominee_bank_name }}</td>
                         </tr>
                        <tr>
                          <td>Branch Name</td>
                          <td>{{ $member->branch_name }}</td>
                          <td>{{ $member->nominee_branch_name }}</td>
                        </tr>
                        <tr>
                            <td>IFSC Code</td>
                            <td>{{ $member->ifsc_code }}</td>
                            <td>{{ $member->nominee_ifsc_code }}</td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><a href="{{ route('BankEditForm') }}" class="btn btn-primary">Edit</a></td>
                            <td><a href="{{ route('NomineeBankEditForm') }}" class="btn btn-primary">Edit</a></td>
                          </tr>
                      </tbody>
                    </table>
                    @if(count($member->documents) > 0)
                    <hr>
                    <h2>Documents</h2>
                    <div class="row">
                    @foreach($member->documents as $doc)
                     <div class="col-md-4">
                       <div class="thumbnail">
                         <a href="{{ asset('documents/' . $doc->file_name) }}" target="_blank">
                           <img src="{{ asset('documents/' . $doc->file_name) }}" alt="#" style="width:100%">
                           <div class="caption">
                             <p style="text-align:center"><b>{{ $doc->document_name }}</b><br>({{ $doc->uploaded_on }})</p>
                           </div>
                         </a>
                       </div>
                     </div>
                    @endforeach
                    </div>
                    @else
                    <p>No Documents</p>
                    @endif
                    @endif
                  </div>
                </div>
              </div>
            </div>
        </div>
      </main>
@endsection