@extends('layout')

@section('content')
    @php /** @var \App\Models\Address|null $address */ @endphp

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" name="first_name" id="first_name" type="text"
                       value="{{ old('first_name', $address ? $address->getFirstName() : '') }}">
            </div>
            <div class="form-group">
                <label for="last_name">Last name</label>
                <input class="form-control" name="last_name" id="last_name" type="text"
                       value="{{ old('last_name', $address ? $address->getLastName() : '') }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" name="phone" id="phone" type="text"
                       value="{{ old('phone', $address ? $address->getPhone() : '') }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" name="email" id="email" type="email"
                       value="{{ old('email', $address ? $address->getEmail() : '') }}">
            </div>
            <div class="form-group mt-5 float-right">
                <a href="/" type="submit" class="btn btn-secondary">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
@stop
