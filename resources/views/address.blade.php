@extends('layout')

@section('content')
    @php /** @var \App\Models\Address|null $address */ @endphp

    <div>
        <dl>
            <dt>First name</dt>
            <dd>{{  $address->getFirstName() }}</dd>

            <dt>Last name</dt>
            <dd>{{  $address->getLastName() }}</dd>

            <dt>Email</dt>
            <dd>{{  $address->getEmail() }}</dd>

            <dt>Phone</dt>
            <dd>{{  $address->getPhone() }}</dd>
        </dl>
        <a class="btn btn-primary" href="/{{ $address->getId() }}/edit">Edit</a>
        <a class="btn btn-danger" href="/{{ $address->getId() }}/delete">Delete</a>
    </div>
@stop
