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
								<th scope="col">Brand</th>
								<th scope="col">Description</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($brand as $bra)
							<tr>
								<th scope="row">{{$bra->id}}</th>
								<th scope="row">{{$bra->brand}}</th>
								<th scope="row">{{$bra->description}}</th>
								<th>	
									<button class="btn btn-success form-control form-control-sm" href="{{route('brand.edit',$bra->id)}}"><i class="mdi mdi-update">Edit</i></button>
									<br>
									<form action="{{route('brand.destroy',$bra->id)}}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn btn-warning form-control form-control-sm"><i class="mdi mdi-delete-empty">Delete</i></button>								
									</form>
								</th>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>								
								<td>
									<a href="{{route('brand.create')}}"><button id="button" class="btn btn-outline-success">Add</button></a>
								</td>
							</tr>
						</tfoot>
					</table>
					{{$brand->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection