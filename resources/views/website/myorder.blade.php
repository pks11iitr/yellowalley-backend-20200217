@extends('website.layout')

@section('mainbody')

    <div id="mainBody">
        <div class="container">
            <div class="row">
				<div class="span12">
					<ul class="breadcrumb">
                        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                        <li class="active"> MY ORDER</li>
                    </ul>
				</div>
                <!-- Sidebar end=============================================== -->
                @include('website.sidebar')
                <div class="span9">
                    <h3>  MY ORDER [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
                    <hr class="soft"/>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <img width="60" src="themes/images/products/4.jpg" alt=""/></td>
                            <td>Spare Part</td>
                            <td>Size1</td>
                            <td>2</td>
                            <td>$120.00</td>
                            <td>$25.00</td>
                            <td>$15.00</td>
                            <td>$110.00</td>
                        </tr>
                        <tr>
                            <td> <img width="60" src="themes/images/products/8.jpg" alt=""/></td>
                            <td>Packagespare</td>
                            <td>Size2</td>
                            <td>2</td>
                            <td>$7.00</td>
                            <td>--</td>
                            <td>$1.00</td>
                            <td>$8.00</td>
                        </tr>
                        <tr>
                            <td> <img width="60" src="themes/images/products/3.jpg" alt=""/></td>
                            <td>Spare Part</td>
                            <td>Size3</td>
                            <td>2</td>
                            <td>$120.00</td>
                            <td>$25.00</td>
                            <td>$15.00</td>
                            <td>$110.00</td>
                        </tr>

                        <tr>
                            <td colspan="7" style="text-align:right">Total Price: </td>
                            <td> $228.00</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Total Discount:	</td>
                            <td> $50.00</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Total Tax: </td>
                            <td> $31.00</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right"><strong>TOTAL ($228 - $50 + $31) =</strong></td>
                            <td class="label label-important" style="display:block"> <strong> $155.00 </strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
