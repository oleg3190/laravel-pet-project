@extends('app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            books
        </div>
        <div class="card-body">
            <a class="mb-2 btn btn-success" href="/book/create">create</a>
            <form action="{{ url('/books/search') }}" method="get">
                <div class="form-group">
                    <input type="text" required name="q" class="form-control" placeholder="Search..." value="{{ request('query') }}" />
                </div>
            </form>
            <div class="container">
                <div class="row">
                    @forelse ($books as $book)

                    <div class="col-md-4">
                        <div class="mb-3 mt-3 ">
                            <div class="card f-flex p-2">
                                <div>title: {{ $book->title }}</div>
                                <div class="content">
                                    author: {{$book->Author->name}}
                                </div>
                                <div class="footer">
                                    <form method="POST" action="/book/{{$book->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div>
                                            <input type="submit" class="btn btn-danger delete-user" value="remove book">
                                        </div>
                                    </form>
                                    <a class="mb-2 btn success" href="/book/{{$book->id}}/edit">edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <p>No books found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection