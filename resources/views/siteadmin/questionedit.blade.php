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
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Question Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('question.update',['id'=>$chapteredit->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputname">Question</label>
                                        <input type="text" name="question" class="form-control" id="exampleInputName" value="{{$chapteredit->question}}" placeholder="question">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Option 1</label>
                                        <input type="text" name="option1" class="form-control" id="exampleInputimage" value="{{$chapteredit->option1}}"placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Option 2</label>
                                        <input type="text" name="option2" class="form-control" id="exampleInputimage" value="{{$chapteredit->option2}}"placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Option 3</label>
                                        <input type="text" name="option3" class="form-control" id="exampleInputimage" value="{{$chapteredit->option3}}"placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Option 4</label>
                                        <input type="text" name="option4" class="form-control" id="exampleInputimage" value="{{$chapteredit->option4}}"placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Active</label>
                                        <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$chapteredit->isactive==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$chapteredit->isactive==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Answer</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="answer" value="1" {{$chapteredit->answer==1?'checked':''}}>
                                            <label for="customRadio1" class="custom-control-label">1</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="answer" value="2" {{$chapteredit->answer==2?'checked':''}} >
                                            <label for="customRadio2" class="custom-control-label">2</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3" name="answer" value="3" {{$chapteredit->answer==3?'checked':''}} >
                                            <label for="customRadio3" class="custom-control-label">3</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4" name="answer" value="4" {{$chapteredit->answer==4?'checked':''}} >
                                            <label for="customRadio4" class="custom-control-label">4</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">ChapterID</label>
                                        <select name="chapter_id" class="form-control" id="exampleInputistop" placeholder="">
                                            @foreach($chapters as $chapter)
                                                <option value="{{$chapter->id}}" {{$chapteredit->chapter_id==$chapter->id?'selected':''}}>{{$chapter->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div  class="col-md-4">
                                        <label for="exampleInputistop">Sequence No</label>
                                        <input type="number" id="exampleInputistop" name="sequence_no" value="{{$chapteredit->sequence_no}}"class="form-control" min="1" max="100">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
