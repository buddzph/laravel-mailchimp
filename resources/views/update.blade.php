@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Contact to Mailchimp</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif

                    <form action="{{ url('/update', $contact->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="email" id="email" value="{{ $contact->email }}" class="form-control">

                        <div class="form-group">
                            <label for="email">Email Address: </label>
                            <strong>{{ $contact->email }}</strong>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $contact->first_name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $contact->last_name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ $contact->phone_number }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-primary">
                            <a class="btn" href="/">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
