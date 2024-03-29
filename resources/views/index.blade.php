@extends('layout')

@section('content')
    <div>
        @if(count($addresses) === 0)
            @if (!empty($search))
                There are no matching addresses for <b>{{ $search }}</b> <a class="btn btn-success" href="/">Clear Filter</a>
            @else
                There are no addresses, click
               <a class="btn btn-success" href="/create">Add</a> to create one.
            @endif
        @else
            <form>
                <input type="search" name="search" placeholder="Search..." value="{{ $search }}">
                <input type="submit" class="btn btn-info" value="Search"/>
            </form>
            <table class="w-100">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>
                        <a class="btn btn-success" href="/create">Add</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($addresses as $address)
                    @php /** @var \App\Models\Address $address */ @endphp
                    <tr>
                        <td>{{ $address->getFirstName() }}</td>
                        <td>{{ $address->getLastName() }}</td>
                        <td>{{ $address->getPhone() }}</td>
                        <td>{{ $address->getEmail() }}</td>
                        <td>
                            <a class="btn btn-info" href="/{{ $address->getId() }}">View</a>
                            <a class="btn btn-primary" href="/{{ $address->getId() }}/edit">Edit</a>
                            <a class="btn btn-danger" href="/{{ $address->getId() }}/delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop
