@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <h1>HOMEPAGE</h1>
    <form action="{{ route('toIndex') }}" method="post">
        @csrf
        @method('GET')
        <div class="form-group">
            <label for="specialization">Specializzazione</label>
            <select class="form-control" id="specialization" name="specialization">
                <option value="">Seleziona una specializzazione</option>
                @foreach ($specs as $spec)
                    <option value="{{ $spec->id }}">{{ $spec->spec_name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary">
                Cerca
            </button>
        </div>
    </form>



@endsection
