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

    <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label for="description">Description</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <label for="ingredients">Ingredients</label>
        <textarea name="ingredients">{{ old('ingredients') }}</textarea>

        <label for="instructions">Instructions</label>
        <textarea name="instructions">{{ old('instructions') }}</textarea>

        <label for="image">Recipe Image</label>
        <input type="file" name="image">

        <button type="submit">Submit</button>
    </form>
@endsection
