@extends('app')
@section('content')
<div class="col-md-4">
    <form method="POST" action="/book">
        @csrf
        <div class="form-group">
            <input class="form-control" id="title" placeholder="title" name="title" required>
        </div>

        <div class="form-group">
            <select class="form-control" name="author">
                @forelse ($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
                @empty
                @endforelse

            </select>
        </div>

        <button type="submit">Save</button>
    </form>
</div>
@endsection