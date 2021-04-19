@extends('layouts.app')
@section('title', 'Home')
@section('content')
<h1 class="custom-h1">SCEGLI IL TUO DOTTORE</h1>
<form action="{{ route('toIndex') }}" method="post">
    @csrf
    @method('GET')
    <div class="form-group">
        <label for="specializations" class="col-md-4 col-form-label">{{ __('Scegli la specializzazione') }}</label>
        <select class="form-control" id="specialization" name="specialization">
            <option value="">Seleziona una specializzazione</option>
            @foreach ($specs as $spec)
            <option value="{{ $spec->id }}" class="opt">{{ $spec->spec_name }}</option>
            @endforeach
        </select>
        <button class="btn custom-button">
            Cerca
        </button>
    </div>
</form>
@endsection
