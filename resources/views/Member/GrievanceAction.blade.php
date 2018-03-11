@extends('layout.app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
        <form action="{{route('GrievanceAction')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <input type="hidden" name="id" value="{{ $g->id }}">
        <table width="95%">
            <thead>
                <tr>
                    <th><img src="{{asset('img/photo.jpg')}}" style="height: 100px;width: 100px;"></th>
                </tr>
                <tr>
                    <th style="padding-left: 60px;text-transform: uppercase;font-weight: bolder;padding-bottom: 0px;"><h1>irs batch 2007</h1></th>
                </tr>
                <tr>
                    <th style="text-align: right; text-transform: capitalize;font-weight: bolder;border-bottom: 2px solid"><b style="float: right;">a registered staff welfare society</b><br><b style="float: right;">a helping hand in problem</b></th>
                </tr>
            </thead>
        </table>
        <table width="95%" style="border-bottom: 2px solid;padding-bottom: 20px;">
            <tbody>
                <tr>
                    <td colspan="2"><h5 style="text-align: center;padding-top: 20px;text-transform: uppercase;"><b>Grevience Form</b></h5></td>

                </tr>
                <tr>
                    <td width="400px"><h5 style="text-transform: uppercase;"><b>Name of Member</b></h5></td>
                    <td><input type="text" style="width: 50%;" value="{{ $g->member_detail->name }}"></td>
                </tr>
                <tr>
                    <td><h5 style="text-transform: uppercase;"><b>Membership Code</b></h5></td>
                    <td><input type="text" style="width: 50%;" value="{{ $g->member_detail->membership_code }}"></td>
                </tr>
                <tr>
                    <td><h5 style="text-transform: uppercase;"><b>Date of submitting Greivence</b></h5></td>
                    <td><input type="text" style="width: 50%;" value="{{ date('d-M-Y', strtotime($g->created_at)) }}"></td>
                </tr>
                <tr>
                    <td><h5 style="text-transform: uppercase;"><b>Details of Greivence</b></h5></td>
                    
                </tr>
                <tr>
                     <td colspan="2"><textarea rows="4" cols="50" style="height: 250px;" readonly>{{ $g->member_text }}</textarea></td>
                </tr>
                <tr>
                     <td colspan="2"><h4>if space is not enough please attach your greivence with this form.</h4></td>
                </tr>
                <tr>
                    <td width="400px"><h5 style="text-transform: uppercase;"><b>Uploaded File</b></h5></td>
                    <td><a href="{{ (!empty($g->file_name))?asset('documents/'.$g->file_name):'#' }}"{{ (!empty($g->file_name))?' target="_blank"':'#' }}>View</a></td>
                </tr>
                <tr>
                    <td width="400px"><h5 style="text-transform: uppercase;"><b>Sign of member</b></h5></td>
                    <td><img src="{{ asset('signature/'.$g->member_signature) }}" style="width:100px"></td>
                </tr>

                <tr>
                        <td><h5 style="text-transform: uppercase;"><b>Lobby Head Remark</b> {{ ($g->lobbyhead_detail)?$g->lobbyhead_detail->name:'' }}</h5></td>
                        
                    </tr>
                    <tr>
                        @if(empty($g->lh_text))
                        <td colspan="2"><textarea rows="4" cols="50" style="height: 50px;" name="lh_text">{{ old('lh_text') }}</textarea></td>
                         @else
                         <td colspan="2"><textarea rows="4" cols="50" style="height: 50px;">{{ $g->lh_text }}</textarea></td>
                         @endif
                    </tr>
                    <tr>
                            <td width="400px"><h5 style="text-transform: uppercase;"><b>signature of lobby head</b></h5></td>
                            <td>    @if(empty($g->lobbyhead_signature))
                                    <input type="file" name="lobbyhead_signature" style="width: 50%;">
                                    @else
                                    <img src="{{ asset('signature/'.$g->lobbyhead_signature) }}" style="width:100px">
                                    @endif</td>
                        </tr>


                <tr>
                    <td><h5 style="text-transform: uppercase;"><b>details of core commitee decision on greivence</b> {{ ($g->corecommittee_detail)?$g->corecommittee_detail->name:'' }}</h5></td>
                    
                </tr>
                <tr>
                    @if(empty($g->cc_text))
                    <td colspan="2"><textarea rows="4" cols="50" style="height: 50px;" name="cc_text">{{ old('cc_text') }}</textarea></td>
                    @else
                    <td colspan="2"><textarea rows="4" cols="50" style="height: 50px;">{{ $g->cc_text }}</textarea></td>
                    @endif
                </tr>
                
                <tr>
                    <td width="400px"><h5 style="text-transform: uppercase;"><b>sign of president/vice-president</b></h5></td>
                    <td>
                        @if(empty($g->president_signature))
                        <input type="file" name="president_signature" style="width: 50%;">
                        @else
                        <img src="{{ asset('signature/'.$g->president_signature) }}" style="width:100px">
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="95%" style="margin-bottom: 50px;">
            <tr>
                <td>
                    <th colspan="2"><h5 style="text-transform: capitalize;text-align: center;margin: 0 auto;padding-top: 20px;"><b>Regd office:-7343,ground floor,gali no 1,near shakti nagar,delhi-110007</b><br><b>Registration No.:S/1180/2015</b><br><b>Email Id:-irsbatch2007@gmail.com</b><br><b>Contact No.:-09015758693</b></h5></th>
                </td>
            </tr>
        
        </table>
        @if($g->stage != "Solved")
        <div class="text-center">
            <button type="submit"  value="Submit" style="padding: 7px 50px;cursor: pointer;text-align: center;margin: 0 auto;">Submit</button>
        </div>
        @endif
        </form>

    </main>
@endsection