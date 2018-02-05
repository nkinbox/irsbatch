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
                              <td>Father/Husband: {{$member->father_husband_name}}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>RailwayId: {{$member->railway_id}}</td>
                              <td>VoterId/Aadhar: {{$member->id_number}}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>PAN: {{$member->pan_card}}</td>
                              <td>Mob: {{$member->mobile_no}}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>PF: {{$member->pf_no}}</td>
                              <td></td>
                              <td>DOB: {{date('d-M-y',strtotime($member->dob))}}</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>DOA: {{date('d-M-y',strtotime($member->doa))}}</td>
                              <td>DOR: {{date('d-M-y',strtotime($member->dor))}}</td>
                            </tr>
                            <tr>
                              <td>Current Address: {{$member->address}}</td>
                            </tr>
                            <tr>
                              <td>Permanent Address: {{$member->permanent_address}}</td>
                            </tr>
                          </tbody>
                        </table>
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
                              <td>{{$member->salutation . ' ' . $member->nominee_name}}</td>
                              <td>{{$member->relationship}}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>{{$member->nominee_phone}}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>{{$member->nominee_address}}</td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
  
                    </div>

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
                             <p style="text-align:center"><b>{{ $doc->document_name }}</b></p>
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
        </div>
      </main>
@endsection