@extends('layouts.app')
@section('title', 'Index')
@section('content')

    <index-component :selected="{{$selected}}" :specializations="{{$specializations}}"></index-component>

@endsection
