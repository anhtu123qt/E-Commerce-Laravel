@extends('admin_layout')
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
            load_feeship();
            function load_feeship() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:'{{url('feeship-ajax')}}',
                    method:'POST',
                    data:{_token:_token},
                    success:function(data){
                        $('#load-feeship').html(data);
                    }
                })
            }
            $('.select').on('change',function(){
                var attr = $(this).attr('id');
                var code = $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var res = '';
                if (attr == 'city') {
                    res = 'district';
                }else {
                    res = 'ward';
                }
                $.ajax({
                    url:'{{url('address-ajax')}}',
                    method:'POST',
                    data:{attr:attr,code:code,_token:_token},
                    success:function(data){
                        $('#'+res).html(data);
                    }
                });
            });
            $('.add-feeship').click(function(e){
                e.preventDefault();
                var city_id = $('.city').val();
                var district_id = $('.district').val();
                var ward_id = $('.ward').val();
                var feeship = $('.feeship').val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:'{{url('add-feeship')}}',
                    method:'POST',
                    data:{city_id:city_id,district_id:district_id,ward_id:ward_id,feeship:feeship,_token:_token},
                    success:function(){
                        load_feeship();
                    }
                })
            })
            $(document).on('blur','.feeship_edit',function(){
                var feeship_id = $(this).data('feeship_edit');
                var feeship = $(this).text();
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:'{{url('update-feeship')}}',
                    method:'POST',
                    data:{feeship_id:feeship_id,feeship:feeship,_token:_token},
                    success:function(data){
                        load_feeship();
                    }
                })
            })
        })
    </script>
</head>
@section('admin_content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Delivery Managerment</h3>
                    </div>
                    <div class="card-body">
                        <div class="position-center">
                            <div class="mb-3">
                                <label class="form-label ">City</label>
                                <select class="form-control select city" name="city_id" id="city" >
                                    <option value="">Select City</option>
                                    @foreach($city as $value)
                                        <option value="{{$value->city_code}}">{{$value->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">District</label>
                                <select class="form-control select district" name="distric_id" id="district" >
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ward</label>
                                <select  class="form-control ward" name="ward_id" id="ward" >
                                    <option value="">Select Ward</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee Ship</label><br>
                                <input type="text" class="form-control feeship">
                            </div>
                            <div class="mb-3">
                                <a class="btn btn-primary add-feeship" href="">Thêm phí vận chuyển</a>
                            </div>
                        </div>
                        <div id="load-feeship">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
