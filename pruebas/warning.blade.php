@extends('layouts.app')

@section('content')
    <div class="alert alert-warning" role="alert">
        <strong>Advertencia:</strong> {{ $warningMessage }}
    </div>
@endsection
