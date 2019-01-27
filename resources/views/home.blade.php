@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of Mailchimp Contacts</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a class="btn btn-primary mb-3" href="/create">Add Contact</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->first_name }}</td>
                                    <td>{{ $contact->last_name }}</td>
                                    <td>{{ $contact->phone_number }}</td>
                                    <td><a href="/update/{{ $contact->id }}">Edit</a> | <a href="/delete/{{ $contact->id }}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
