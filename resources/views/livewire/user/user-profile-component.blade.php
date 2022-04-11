<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Profile</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						@if(Auth::user()->hasRole('admin'))							
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@elseif(Route::has('login'))
							<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@endif
						<li class="breadcrumb-item active"><a href="{{ route('user.profile') }}" class="fw-normal">Profile</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
			<!-- Column -->
			<div class="col-lg-4 col-xlg-3 col-md-12">
				<div class="white-box">
					<div class="user-bg"> <img width="100%" alt="user" src="{{ asset('assets/images/profile') }}/{{ $user->profile->image }}">
						<div class="overlay-box">
							<div class="user-content">
								<a href="javascript:void(0)"><img src="{{ asset('assets/images/profile_thumbnail') }}/{{ $user->profile->image }}"
										class="thumb-lg img-circle" alt="img"></a>
								<h4 class="text-white mt-2">{{ $user->name }}</h4>
								<h5 class="text-white mt-2">{{ $user->email }}</h5>
							</div>
						</div>
					</div>
					<div class="user-btm-box mt-5 d-md-flex">
						<div class="col-md-4 col-sm-4 text-center">
							<h1>258</h1>
						</div>
						<div class="col-md-4 col-sm-4 text-center">
							<h1>125</h1>
						</div>
						<div class="col-md-4 col-sm-4 text-center">
							<h1>556</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-8 col-xlg-9 col-md-12">
				<div class="card">
					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
							<h5><i class="icon fas fa-check"></i> Profile Updated!</h5>{{ Session::get('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="card-body">
						<div class="form-group mb-2 border-bottom">
							<p><b>Name: </b> {{ $user->name }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Email: </b> {{ $user->email }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Mobile No: </b> {{ $user->profile->mobile }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Line 1: </b> {{ $user->profile->line1 }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Line 2: </b> {{ $user->profile->line2 }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>City: </b> {{ $user->profile->city }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Province: </b> @if($user->profile->province_id) {{ $user->profile->province->name  }} @endif</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Country: </b> @if($user->profile->country_id) {{ $user->profile->country->name  }} @endif</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Zipcode: </b> {{ $user->profile->zipcode }}</p>
						</div>
						<div class="form-group mb-4">
							<div class="col-sm-12">
								<a href="{{ route('user.editprofile') }}" class="btn btn-success">Edit Profile</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
		<!-- Row -->
		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->
		<!-- .right-sidebar -->
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
</div>
