@extends('layouts.master')

@section('main')
    <h1>Create a Post</h1>
    <form action="{{ route('savePost') }}" method="POST">
        @csrf
        <textarea name="content" placeholder="Write something..." required></textarea><br>
        <input type="text" name="image" placeholder="Image URL"><br>
        <button type="submit">Create Post</button>
    </form>
@endsection