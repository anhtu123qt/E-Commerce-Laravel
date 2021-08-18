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
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">Phone</th>
								<th scope="col">Total</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
							<tr>
								<th scope="row">{{$order->id}}</th>
								<th scope="row">{{$order->name}}</th>
								<th scope="row">{{$order->email}}</th>
								<th scope="row">{{$order->phone}}</th>
								<th scope="row">{{$order->total}}$</th>
								<th scope="row">
									<a href=""><i class="mdi mdi-alarm-plus"></i> Duyet </a>
								</th>
							</tr>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

































































