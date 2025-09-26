@extends('layouts.app')

@section('content')
    <h1>Submit a New Recipe</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Index</h1>
@endsection
