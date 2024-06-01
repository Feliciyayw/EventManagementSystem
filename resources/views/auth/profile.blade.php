@extends('template.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
{{--
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Create Data
    </button> --}}

    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Update Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{url('update-profile-users')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="hidden" name = "id_users" value = "{{$data['profile']->id}}" >
                                <input type="text" name = "name" class="form-control" required value = "{{$data['profile']->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name = "phone_number" class="form-control" required value = "{{$data['profile']->phone_number}}">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name = "email" class="form-control" required value = "{{$data['profile']->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name = "alamat" class="form-control" required value = "{{$data['profile']->alamat}}">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Input yout Password for data confirmation</label>
                                <input type="password" class="form-control" required name = "password" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-right">
                                <button type = "submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>



@endsection
