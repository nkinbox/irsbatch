@extends('layout.app')

@section('content')
@if(session('mode'))
@if(session('mode') == "member")
@include('Dashboard.Member')
@elseif(session('mode') == "president")
@include('Dashboard.President')
@elseif(session('mode') == "lobbyhead")
@include('Dashboard.LobbyHead')
@elseif(session('mode') == "corecommittee")
@include('Dashboard.CoreCommittee')
@endif
@else
@include('Dashboard.Member')
@endif
@endsection
