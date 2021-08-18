 @extends('frontend_layout')
 <head>
 	<script>
 		if(screen.width <= 736){
 			document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
 		}
 	</script>
 	<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/rate.css')}}">
 	<script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
 	<script>
 		$.ajaxSetup({
 			headers: {
 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			}
 		});
 		$(document).ready(function(){
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	            	$(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	            	$(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	            );

			$('.ratings_stars').click(function(){
				var Values =  $(this).find("input").val();
				var blog_id = "{{$getBlogSingle->id}}";
				var _token = $('meta[name="csrf-token"]').attr('content');
				// alert(Values);
				if ($(this).hasClass('ratings_over')) {
					$('.ratings_stars').removeClass('ratings_over');
					$(this).prevAll().andSelf().addClass('ratings_over');
				} else {
					$(this).prevAll().andSelf().addClass('ratings_over');
				}
				$.ajax({
					url:"{{url('rating')}}",
					type:"POST",
					data:{Values:Values,blog_id:blog_id,_token:_token},
					success:function(data) {
						if (data=='done') {
							alert("Ban da danh gia thanh cong");
						}else {
							alert("Ban chua dang nhap");
							window.location.assign('{{url('member')}}');
						}
					}
				});
			});
			
			// alert(blog_id);
			$('.post-cmt').click(function(){
				var blog_id = "{{$getBlogSingle->id}}"; 
				var cmt_name = $('.cmt_name').val();
				var cmt = $('.comment').val();
				var _token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					url:"{{url('add-cmt')}}",
					type:"POST",
					data:{blog_id:blog_id,cmt_name:cmt_name,cmt:cmt,_token:_token},
					success:function(data){
						if (data ='done') {
							alert('Cam on ban da phan hoi');
						}
						$('.cmt_name').val('');
						$('.comment').val('');
					}
				});
			});
			$('.reply').click(function(e){
				e.preventDefault();
				var cmt_id = $(this).val();
				$('.reply-section').html("");
				$(this).closest('.media-body').find('.reply-section').
				html('<div class="col-sm-8"><input type="text" class="reply_name" placeholder="Your name"><br><br><textarea class="reply_cmt" rows="5" placeholder="Your comment"></textarea><button class="btn btn-primary post-reply">Post Reply</button></div></div>');
				$('.post-reply').click(function() {
					var blog_id = "{{$getBlogSingle->id}}";
					var reply_name = $('.reply_name').val();
					var reply = $('.reply_cmt').val();
					var _token = $('meta[name="csrf-token"]').attr('content');
					// alert(reply);
					$.ajax({
						url:"{{url('add-reply')}}",
						type:"POST",
						data:{cmt_id:cmt_id,blog_id:blog_id,reply_name:reply_name,reply:reply,_token:_token},
						success:function(data) {
							if (data = 'done') {
								alert('Cam on ban da phan hoi')
							}
							$('.reply_name').val('');
							$('.reply').val('');
						}
					});
				});
			});
		});
	</script>
</head>
@section('menu-left_frontend_layout')
<div class="left-sidebar">
	<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Sportswear
					</a>
				</h4>
			</div>
			<div id="sportswear" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Nike </a></li>
						<li><a href="#">Under Armour </a></li>
						<li><a href="#">Adidas </a></li>
						<li><a href="#">Puma</a></li>
						<li><a href="#">ASICS </a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#mens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Mens
					</a>
				</h4>
			</div>
			<div id="mens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
						<li><a href="#">Armani</a></li>
						<li><a href="#">Prada</a></li>
						<li><a href="#">Dolce and Gabbana</a></li>
						<li><a href="#">Chanel</a></li>
						<li><a href="#">Gucci</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#womens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Womens
					</a>
				</h4>
			</div>
			<div id="womens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Kids</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Fashion</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Households</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Interiors</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Clothing</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Bags</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Shoes</a></h4>
			</div>
		</div>
	</div><!--/category-products-->

	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
				<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
				<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
				<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
				<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
				<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
				<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
			</ul>
		</div>
	</div><!--/brands_products-->

	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
			<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div><!--/price-range-->

	<div class="shipping text-center"><!--shipping-->
		<img src="{{asset('frontend/images/home/shipping.jpg')}}" alt="" />
	</div><!--/shipping-->
</div>
@endsection
@section('frontend_content')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		<div class="single-blog-post">
			<h3>{{$getBlogSingle->title}}</h3>
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i> Mac Doe</li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul>
				<span>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</span>
			</div>
			<p>{{$getBlogSingle->description}}</p>
			<a href="">
				<img src="{{ asset('upload/blog/'.$getBlogSingle->image) }}" alt="">
			</a>
			<p>{{$getBlogSingle->content}}</p>
			<div class="pager-area">
				<ul class="pager pull-right">
					<li><a href="{{URL::to('blog/single/'.$previous)}}">Pre</a></li>
					<li><a href="{{URL::to('blog/single/'.$next)}}">Next</a></li>
				</ul>
			</div>

		</div>
	</div><!--/blog-post-area-->
	<div class="rate">
		<div class="vote">
			@for($i=1;$i<=5;$i++)
			<div class="ratings_stars {{ $i <= round($rating) ? 'ratings_over' : '' }}"><input value="{{$i}}" type="hidden"></div>
			@endfor	
			<span class="rate-np">{{round($rating)}}</span>
		</div> 
	</div>
	{{-- <div class="rating-area">
		<ul class="ratings">
			<li class="rate-this">Rate this item:</li>
			<li>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</li>
			<li class="color">(6 votes)</li>
		</ul>
		<ul class="tag">
			<li>TAG:</li>
			<li><a class="color" href="">Pink <span>/</span></a></li>
			<li><a class="color" href="">T-Shirt <span>/</span></a></li>
			<li><a class="color" href="">Girls</a></li>
		</ul>
	</div> --}}<!--/rating-area-->

	<div class="socials-share">
		<a href=""><img src="images/blog/socials.png" alt=""></a>
	</div><!/socials-share>

	<div class="media commnets">
		<a class="pull-left" href="#">
			<img class="media-object" src="{{asset('frontend/images/blog/man-one.jpg')}}" alt="">
		</a>
		<div class="media-body">
			<h4 class="media-heading">Annie Davis</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<div class="blog-socials">
				<ul>
					<li><a href=""><i class="fa fa-facebook"></i></a></li>
					<li><a href=""><i class="fa fa-twitter"></i></a></li>
					<li><a href=""><i class="fa fa-dribbble"></i></a></li>
					<li><a href=""><i class="fa fa-google-plus"></i></a></li>
				</ul>
				<a class="btn btn-primary" href="">Other Posts</a>
			</div>
		</div>
	</div><!--Comments-->
	<div class="response-area">
		<h2>RESPONSES</h2>
		<ul class="media-list">
			{{-- {{dd($comments->toArray())}} --}}
			@foreach($comments as $comment)
			@if($comment->level == 0)
			<li class="media">
				<a class="pull-left" href="#">
					<img class="media-object" src="" alt="">
				</a>
				<div class="media-body">
					<ul class="sinlge-post-meta">
						<li><i class="fa fa-user"></i>{{$comment->name}}</li>
						<li><i class="fa fa-calendar"></i>{{$comment->cmt_date}}</li>
					</ul>
					<p>{{$comment->content}}</p>
					<button value="{{$comment->cmt_id}}" class="btn btn-primary reply"><i class="fa fa-reply"></i></button>		
					<div class="col-sm-8 reply-section">
						{{-- Replysection --}}
					</div>
				</div>
			</li>
			@endif
				@foreach($replies as $reply)
					@if($reply->level == $comment->cmt_id)
						<li class="media second-media">
							<a class="pull-left" href="#">
								<img class="media-object" src="{{asset('frontend/images/blog/man-three.jpg')}}" alt="">
							</a>
							<div class="media-body">
								<ul class="sinlge-post-meta">
									<li><i class="fa fa-user"></i>{{$reply->name}}</li>
									<li><i class="fa fa-calendar"></i>{{$reply->cmt_date}}</li>
								</ul>
								<p>{{$reply->content}}</p>
								<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
							</div>
						</li>
					@endif	
				@endforeach	
			@endforeach
		</ul>

	</div><!--/Response-area-->
	<div class="replay-box">
		<div class="row">
			<div class="col-sm-8">
				<div class="text-area">
					<input type="text" class="cmt_name" placeholder="Your name"><br><br> 
					<textarea class="comment" rows="11" placeholder="Your comment"></textarea>
					<button class="btn btn-primary post-cmt">Post Comment</button>
				</div>
			</div>
		</div>
	</div><!--/Repaly Box-->
</div>	
@endsection


