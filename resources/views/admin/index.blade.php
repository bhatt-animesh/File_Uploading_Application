@extends('theme.default')

@section('content')
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                <a href="{{URL::to('/admin/product')}}" aria-expanded="false">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total File Upload By Users</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ count($getproduct) }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-list-alt"></i></span>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                <a href="{{URL::to('/admin/users')}}" aria-expanded="false">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Users</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ count($getusers) }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
@endsection