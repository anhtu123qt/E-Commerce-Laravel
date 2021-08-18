@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('success')}}
	</div>
	@endif
	@if(session('delete'))
	<div class="alert alert-danger alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('delete')}}
	</div>
	@endif
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Title</th>
								<th scope="col">Image</th>
								<th scope="col">Description</th>
								<th scope="col">Content</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($getBlog as $blog)
							<tr>
								<th scope="row">{{$blog->id}}</th>
								<th scope="row">{{$blog->title}}</th>
								<th scope="row">{{$blog->image}}</th>
								<th scope="row">{{$blog->description}}</th>
								<th scope="row">{{$blog->content}}</th>
								<td>	
									<a href="{{route('blog.edit',$blog->id)}}"><button class="btn btn-success form-control btn-block"><i class="mdi mdi-update">Edit</i></button></a>
									<br>
									<form action="{{route('blog.destroy',$blog->id)}}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger btn-block"><i class="mdi mdi-delete-empty">Delete</i></button>									
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td>
									<a href="{{route('blog.create')}}"><button id="button" class="btn btn-outline-success">Add blog</button></a>
								</td>
							</tr>

						</tfoot>
					</table>
				<nav>{{$getBlog->links()}}</nav>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

































































