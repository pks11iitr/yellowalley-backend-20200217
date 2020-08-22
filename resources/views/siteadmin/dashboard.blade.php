@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">Dashboard</li>--}}
{{--                        </ol>--}}
{{--                    </div><!-- /.col -->--}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{$chapters}}/{{$videos}}/{{$questions}}</h4>

                                <p>Chapters/Vides/Questions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('chapter.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>{{$usersnew}} New/ {{$users}} Total</h4>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('users.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>{{$paidusers}} Paid/ {{$users-$paidusers}} Total</h4>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('users.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>{{$completeuser}} User</h4>
                                <p>Completed Course</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('users.list')}}?completed=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="callout callout-info">
                <h4 style="background-color: #ffc800;">About Company</h4>

                <p style="text-align: justify">We are a group of passionate people with a vision to disseminate knowledge among students rather teaching. Yellow Alley is fueled by wisdom and motivation of its pioneer faculty members who teaches with all the dedication in their specialized field. The organization has been established with a goal to strengthen the capabilities and empower a student’s practical knowledge through our courses.</p>
            </div>
            <!-- Default box -->

            <!-- /.box -->
        </section>
        <section class="content">
            <div class="callout callout-info">
                <h4 style="background-color: #ffc800">About App</h4>

                <p style="text-align: justify">Yellow Alley is a full-service Digital Marketing Course offering a wide range of Topics. From executing innovative and path-breaking ideas to developing cutting edge strategies on all Digital Marketing platform along with real time examples and case studies to provide in depth and effective knowledge. Yellow Alley Digital Marketing Course is at the forefront of exploding digital landscape. This Course is a born-in Digital Company that uniquely combines the power of technology, analytics, creative and content for digital transformation.</p>
            </div>
            <!-- Default box -->

            <!-- /.box -->
        </section>
        <section class="content">
            <div class="callout callout-info">
                <h4 style="background-color: #ffc800">Company History</h4>

                <p style="text-align: justify">Unlike most of the institutes we are not limited to theory and study materials rather we focus on individual learning by providing practical guidance and hand on experience with real life examples. Established by a team of highly motivated and enthusiastic industry experts, Yellow Alley aspire to make their student’s dream come true.</p>
<p style="text-align: justify">
                    We are a group of passionate people who have the potential to understand the context of education era in the education world. Yellow Alley has been formed with an idea to change the concept of education. We are true believers of avant-garde education on the web which results in virality!
</p>
                <p style="text-align: justify">
                    We promote the ideas of innovation and encourage students to learn by exploring and experimenting. It is the specialization that enables us to guide our students step by step towards overall excellence that leads to success.

                </p>
            </div>
            <!-- Default box -->

            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @endsection
