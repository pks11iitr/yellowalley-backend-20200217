@extends('layouts.admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Score</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Score Table</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Select User: </label>

                                        <input type="text" name="user" value="{{request('user')}}">


                                <button type="submit" class="btn" style="background-color: black;color: white">Apply</button>
                                <a type="submit" class="btn" style="background-color: black;color: white" href="{{route('userscore.list')}}">Reset</a>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{$userscores->appends(request()->query())->links()}}
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User(Name)</th>
                                    <th>Chapter(Title)</th>
                                    <th>Score</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userscores as $user)
                                    <tr>
                                        <td>{{$user->user->name}}</td>
                                        <td>{{$user->chapter->title}}</td>
                                        <td>{{$user->score}}</td>
                                        <td>{{$user->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$userscores->appends(request()->query())->links()}}
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
