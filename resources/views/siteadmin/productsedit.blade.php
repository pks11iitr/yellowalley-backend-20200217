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
                            <li class="breadcrumb-item active">Products</li>
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
                                <h3 class="card-title">Products Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('products.update',['id'=>$product->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Name" value="{{$product->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Company</label>
                                        <input type="text" name="company" class="form-control" id="exampleInputEmail1" placeholder="Company" value="{{$product->company}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Price</label>
                                        <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Price" value="{{$product->price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Cut Price</label>
                                        <input type="text" name="cut_price" class="form-control" id="exampleInputEmail1" placeholder="Price" value="{{$product->cut_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Minimum Purchase Quantity</label>
                                        <input type="text" name="minimum_quantity" class="form-control" id="exampleInputEmail1" placeholder="Price" value="{{$product->minimum_quantity}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Weight of Single Item(in kgs i.e 1.2 kg or 5.5 kg)</label>
                                        <input type="text" name="product_weight" class="form-control" id="exampleInputEmail1" placeholder="Price" value="{{$product->product_weight}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Delivery Charge Per kg</label>
                                        <input type="text" name="delivery_per_kg_price" class="form-control" id="exampleInputEmail1" placeholder="Price" value="{{$product->delivery_per_kg_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Image</label>
                                        <input type="file" name="productsimage" class="form-control" id="exampleInputimage" placeholder="">
                                        <img src="{{$product->image}}" width="200" height="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Active</label>
                                        <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$product->isactive==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$product->isactive==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Latest</label>
                                        <select name="islatest" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$product->islatest==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$product->islatest==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Featured</label>
                                        <select name="isfeatured" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="0" {{$product->isfeatured==0?'selected':''}}>No</option>
                                            <option value="1" {{$product->isfeatured==1?'selected':''}}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Rating</label>
                                        <input type="text" name="rating" class="form-control" id="exampleInputEmail1" placeholder="Rating" value="{{$product->rating}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Category ID</label>
                                        <select name="categoryid" class="form-control" id="exampleInputistop" placeholder="">
                                            <option>Select Category ID</option>
                                            @foreach($allcategorys as $c)
                                                <option value="{{$c->id}}"   {{$product->categoryid==$c->id?'selected':''}}>{{$c->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputdescription">Description</label>
                                        <textarea name="description" class="form-control" id="exampleInputdescription" placeholder="Description">{{$product->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">In The Box</label>
                                        <input type="text" name="inthebox" class="form-control" id="exampleInputEmail1" placeholder="In The Box" value="{{$product->in_the_box}}">
                                    </div>
                                </div>

{{--                                <div class="card-body">--}}
{{--                                    <label>Enter Size Options</label>--}}
{{--                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th><i class="fas fa-check-square"></i></th>--}}
{{--                                            <th>Size</th>--}}
{{--                                            <th>Price</th>--}}
{{--                                            <th>Cut Price</th>--}}
{{--                                            <th>GST</th>--}}
{{--                                            <th>Delivery charge</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody class="col-sm-3">--}}
{{--                                        @for($i=0;$i<10;$i++)--}}
{{--                                            <tr >--}}
{{--                                                <td> <input type="checkbox" id="checkboxPrimary1" name="priceids[]" value="{{isset($product->sizeprice[$i])?$product->sizeprice[$i]->id:0}}" @if(isset($product->sizeprice[$i])&& $product->sizeprice[$i]->isactive==1){{'checked'}}@endif>--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <input type="text" name="sizes[]" value="{{$product->sizeprice[$i]->size??''}}">--}}

{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <input type="text" name="prices[]" value="{{$product->sizeprice[$i]->price??''}}">--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <input type="text" name="cutprices[]" value="{{$product->sizeprice[$i]->cut_price??''}}">--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <input type="text" name="gsts[]" value="{{$product->sizeprice[$i]->gst??''}}">--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <input type="text" name="del_charges[]" value="{{$product->sizeprice[$i]->deliverycharge??''}}">--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endfor--}}

{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}


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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Gallery Images</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('products.addgallery',['id'=>$product->id])}}">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputimage">Header Image</label>
                                        <input type="file" name="gallery[]" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                    <div class="form-group">
                                @foreach($product->gallery as $e)
                                    <img src="{{$e->doc_path}}" height="100px" width="200px"/>
                                        <a href="{{route('products.detgallery',['id'=>$e->id])}}">X</a>
                                    @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
    </section>

    </div>
@endsection
