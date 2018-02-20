@extends('layout.app')
@section('content')
<main class="main-content p-4 invisible" data-qp-animate-type="fadeIn" data-qp-animate-delay="600" role="main">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 pb-5">
                            <h2>Office Bearers</h2>
                            
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Position</th>
                                        <th>Name</th>
                                        <th>HQ</th>
                                        <th>Membership Code</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $j = 0; ?>
                                    @foreach($list as $office_bearer)
                                    <tr>
                                        <th scope="row"><?php $j++; echo $j;?></th>
                                        <td>{{ $office_bearer->position }}</td>
                                        <td><?php $i = 0; ?>
                                            @foreach($office_bearer->position_holder as $member)
                                            <?php if($i) echo "<hr>"; $i++;  ?>{{ $member->name }}
                                            @if(session('mode') == "president")
                                            <a href="#" onclick="event.preventDefault();
                                            document.getElementById('remove_{{$j.$i}}').submit();">Remove</a>
                                            <form id="remove_{{$j.$i}}" action="{{ route('UpdateOfficeBearer') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="position_id" value="0">
                                            <input type="hidden" name="membership_code" value="{{ $member->membership_code }}">
                                            </form>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td><?php $i = 0; ?>
                                            @foreach($office_bearer->position_holder as $member)
                                            <?php if($i) echo "<hr>"; $i++;  ?>{{ $member->hq }}
                                            @endforeach
                                        </td>
                                        <td><?php $i = 0; ?>
                                            @foreach($office_bearer->position_holder as $member)
                                            <?php if($i) echo "<hr>"; $i++;  ?>{{ $member->membership_code }}
                                            @endforeach
                                        </td>
                                        <td><?php $i = 0; ?>
                                            @foreach($office_bearer->position_holder as $member)
                                            <?php if($i) echo "<hr>"; $i++;  ?>{{ $member->mobile_no }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(session('mode') == "president")
                            <form  action="{{ route('UpdateOfficeBearer') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="position" class="active">Position</label>
                                        <select id="position" name="position_id" class="form-control">
                                            @foreach($list as $office_bearer)
                                            <option value="{{ $office_bearer->id }}"{{ (old('position_id') == $office_bearer->id) ? ' selected' : '' }}>{{ $office_bearer->position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mcode" class="active">Membership Code</label>
                                        <input id="mcode" type="text" class="form-control" name="membership_code" placeholder="Membership Code" value="{{ old('membership_code') }}">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
