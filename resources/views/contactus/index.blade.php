@extends('adminlte::page')

@section('title', 'Contacts')

@section('content_header')
    <h1>Contacts</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">link</th>
            <th scope="col">icon</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <th scope="row">{{$contact['id']}}</th>
                <td>{{$contact['link']}}</td>
                <td>
                   <img width="150" height="100px" src="{{url('images/ads/' .$contact['icon'])}}" alt="photo">
                </td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <a href="{{url('contact/edit/' . $contact['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('contacts.delete', $contact['id']) }}" method='POST'>
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
{{--   <a href="{{url('ads/create')}}"> <button class="btn btn-bg btn-success">Add Contact</button></a>--}}
@stop

