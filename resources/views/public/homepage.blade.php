@extends('layouts.app')
@section('title', 'Home')
@section('content')
<h1 class="custom-h1">CERCA IL DOTTORE ADATTO A TE</h1>
<form action="{{ route('toIndex') }}" method="post">
    @csrf
    @method('GET')
    <div class="form-group">
        <select class="form-control" id="specialization" name="specialization" required>
            <option value="">Seleziona la specializzazione</option>
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
