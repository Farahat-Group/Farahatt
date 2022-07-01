@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Ads</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">Image</th>

            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($boards as $board)
            <tr>
                <th scope="row">{{$board['id']}}</th>
                <td>{{$board['title']}}</td>
                <td>{{$board['description']}}</td>
                <td>
                   <img width="150" height="100px" src="{{url('images/boards/' .$board['image'])}}" alt="photo">
                </td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <a href="{{url('board/edit/' . $board['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('boards.delete', $board['id']) }}" method='POST'>
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-bg btn-danger">

                            </form>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

