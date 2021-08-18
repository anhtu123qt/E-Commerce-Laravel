@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('success')}}
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
								<th scope="col">Country</th>
								<th scope="col">Description</th>
								<th scope="col">Image</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($countries as $country)
							<tr>
								<th scope="row">{{$country->id}}</th>
								<th scope="row">{{$country->country}}</th>
								<th scope="row">{{$country->description}}</th>
								<th scope="row">{{$country->image}}</th>
								<td>	
									<a href="{{route('country.edit',$country->id)}}"><button class="btn btn-success form-control btn-block"><i class="mdi mdi-update">Edit</i></button></a>
									<br>
									<form action="{{route('country.destroy',$country->id)}}" method="POST">
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
									<a href="{{route('country.create')}}"><button id="button" class="btn btn-outline-success">Add</button></a>
								</td>
							</tr>
						</tfoot>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

































































