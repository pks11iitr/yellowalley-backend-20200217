<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="{{route('website.cartdetails')}}"><img src="{{asset('vendor/themes/images/ico-cart.png')}}" alt="cart">{{$cart['items']??0}} Items in your cart  <span class="badge badge-warning pull-right">{{$cart['total']??0 }} INR</span></a></div>

    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($categorys as $category)
        <li class="subMenu open"><a> {{$category->title}}</a>
            <ul>
                @foreach($category->subcategories as $cate)
                <li>
                    <a class="active" href="{{route('website.category.product', ['id'=>$cate->id])}}"><i class="icon-chevron-right"></i>{{$cate->title}}</a></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

    <br/>

</div>
