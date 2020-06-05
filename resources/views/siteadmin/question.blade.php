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
                            <li class="breadcrumb-item active">Question</li>
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
                            <h3 class="card-title">Total Questions: {{$questions->total()}}</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Select Chapter: </label>
                                <select name="chapter">
                                    <option value=""></option>
                                    @foreach($chapters as $chapter)
                                        <option value="{{$chapter->id}}" @if(request('chapter')== $chapter->id){{'selected'}}@endif>{{$chapter->title}}</option>
                                    @endforeach
                                </select>
                                <label>Text To Search:</label> <input type="text" name="search" value="{{request('search')}}">
                                <button type="submit" class="btn" style="background-color: black;color: white">Apply</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{$questions->appends(request()->query())->links()}}
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Option1</th>
                                    <th>Option2</th>
                                    <th>Option3</th>
                                    <th>Option4</th>
                                    <th>Isactive</th>
                                    <th>Answer</th>
                                    <th>ChapterID</th>
                                    <th>SequenceNo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{$question->question}}</td>
                                        <td>{{$question->option1}}</td>
                                        <td>{{$question->option2}}</td>
                                        <td>{{$question->option3}}</td>
                                        <td>{{$question->option4}}</td>
                                        <td>
                                            @if($question->isactive==1){{'Yes'}}
                                                @else{{'No'}}
                                                @endif
                                        </td>
                                        <td>{{$question->answer}}</td>
                                        <td>{{$question->chapter->title}}</td>
                                        <td>{{$question->sequence_no}}</td>
                                        <td><a href="{{route('question.edit',['id'=>$question->id])}}" class="btn btn-warning">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$questions->appends(request()->query())->links()}}
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
