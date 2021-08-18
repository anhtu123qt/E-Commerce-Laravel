@extends('admin_layout')
@section('admin_content')
<div class="row">
	@if($errors->any())
	<div class="alert alert-danger alert-dismissible">
		<h4><i class="icon fa fa-check"></i>Thông báo!</h4>
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="col-12">
		<div class="card card-body">
			<h2 class="card-title">Add Blog</h2>
			<form class="form-horizontal m-t-30" action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('POST')
				<div class="form-group">
					<label>Title <span class="help"></span></label>
					<input type="text" class="form-control" name="title" value="">
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea name="description" value="" class="form-control" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label>Image file upload</label>
					<input type="file" name="image" class="form-control">
				</div>
				<div class="form-group">
					<label>Content</label>
					<textarea id="ckeditor" name="content" value="" class="form-control" rows="10"></textarea>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-success" name="add">Add</button>
					<a href="{{route('blog.index')}}"><button type="button" class="btn btn-success">Cancel</button></a>
				</div>
			</form>

		</div>

	</div>
	@endsection