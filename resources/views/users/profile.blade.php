@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{url('images/user4-128x128.jpg')}}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{$user->name}}</h3>
                        <p class="text-muted text-center">{{$user->email}}</p>
                    </div>
                </div>
            </div> -->
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                @include('adminlte-templates::common.errors')
                                @include('flash::message')
                                {!! Form::model($user, ['route' => ['users.updateProfile', $user->id], 'method' => 'patch']) !!}
                                <div class="form-group row">
                                    {!! Form::label('first_name', 'First Name:',['class' => 'required col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('last_name', 'Last Name:',['class' => 'required col-sm-3 col-form-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <!-- Name Field -->
                                <div class="form-group row">
                                    {!! Form::label('name', 'Title:',['class' => 'required col-sm-3 col-form-label']) !!}

                                    <div class="col-sm-9">
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <!-- Email Field -->
                                <div class="form-group row">
                                    {!! Form::label('email', 'Email:',['class' => 'required col-sm-3 col-form-label' ]) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <!-- Password Field -->
                                <div class="form-group row">
                                    {!! Form::label('password_new', 'Password:',['class' => 'col-sm-3 col-form-label' ]) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('password_new', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('last_login_ip', 'Last login ip:',['class' => 'required col-sm-3 col-form-label' ]) !!}
                                    <div class="col-sm-9">
                                        <span class="form-control">{{ $user->last_login_ip }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('last_login_at', 'Last login at:',['class' => 'required col-sm-3 col-form-label' ]) !!}
                                    <div class="col-sm-9">
                                        <span class="form-control">{{ $user->last_login_at }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
