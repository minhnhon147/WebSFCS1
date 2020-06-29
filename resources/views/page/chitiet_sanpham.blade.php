@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Chi tiết sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index">Trang chủ</a> / <span>Product</span>
				</div>
			</div>
			{{--  {{dd($product->unit_price)}}  --}}

			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{$product->image}}" alt="">
						</div>
						<div class="col-sm-8">
						
							<div class="single-item-body">
								<p class="single-item-title">{{$product->name}}</p>
								<p class="single-item-price">
									<span>{{$product->unit_price}}</span>
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$product->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								
								
								<select class="wc-select" name="color">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="add-to-cart/{{$product->id}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$product->description}}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm tương tự</h4>

						<div class="row">
							@foreach ($productAll as $p)
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="chi-tiet-san-pham/{{$p->id}}"><img src="source/image/product/{{$p->image}}" alt=""height="200" width="250"/></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$p->name}}</p>
										<p class="single-item-price">
											<span>{{$p->unit_price}}</span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="add-to-cart/{{$p->id}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="chi-tiet-san-pham/{{$p->id}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach

						</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản phẩm</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($sp_khac as $sp_k)
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet-san-pham/{{$sp_k->id}}"><img src="source/image/product/{{$sp_k->image}}" alt=""></a>
									<div class="media-body">
										{{$sp_k->name}}
										<span class="beta-sales-price">{{$sp_k->unit_price}}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($new_product as $new)
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet-san-pham/{{$new->id}}"><img src="source/image/product/{{$new->image}}" alt=""></a>
									<div class="media-body">
										{{$new->name}}
										<span class="beta-sales-price">{{$new->unit_price}}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection