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
				<h4 class="page-title">Profile Edit</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						@if(Auth::user()->hasRole('admin'))							
							<li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@elseif(Route::has('login'))
							<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@endif
						<li class="breadcrumb-item"><a href="{{ route('user.profile') }}" class="fw-normal">Profile</a></li>
						<li class="breadcrumb-item active"><a href="#" class="fw-normal">Edit</a></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
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
					<div class="user-bg"> <img width="100%" alt="user" src="{{ asset('assets/images/profile') }}/{{ $image }}">
						<div class="overlay-box">
							<div class="user-content">
								<a href="javascript:void(0)">
									@if ($image)
										<img src="{{ asset('assets/images/profile_thumbnail') }}/{{ $image }}" class="thumb-lg img-circle" alt="img">
									@else
										<img src="{{ asset('assets/images/profile/default.jpg') }}" class="thumb-lg img-circle" alt="img">
									@endif
								</a>
								<h4 class="text-white mt-2">User Name</h4>
								<h5 class="text-white mt-2">info@myadmin.com</h5>
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
					<div class="card-body">						
						<form class="form-horizontal form-material" wire:submit.prevent="updateProfile">
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Profile Image</label>
								<div class="col-md-12   p-0">
									<input type="file" class="custom-file-input form-control" wire:model="newimage" wire:ignore>
								</div>
								<div class="col-md-12 p-0">
									{{-- @if ($newimage)
										<img src="{{ $newimage->temporaryUrl() }}" alt="" width="120">
									@endif --}}
									@if ($image)
										<img src="{{ asset('assets/images/profile') }}/{{ $image }}" alt="" width="120">
									@else
										<img src="{{ asset('assets/images/profile/default.jpg') }}" alt="" width="120">
									@endif
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Full Name</label>
								<div class="col-md-12   p-0">
									<input type="text" placeholder="Enter Full Name" class="form-control p-0 border-0" wire:model="name">
								</div>
							</div>
							<div class="form-group mb-4">
								<div class="form-group mb-4">
									<label class="col-md-12 p-0">Email</label>
									<div class="col-md-12   p-0">
										<p class="form-control p-0 border-0">{{ $email }}</p>
									</div>
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Phone No</label>
								<div class="col-md-12 border-bottom p-0">
									<input type="text" placeholder="Enter Phone Number" class="form-control p-0 border-0" wire:model="mobile">
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Line 1</label>
								<div class="col-md-12 border-bottom p-0">
									<input type="text" placeholder="Enter Line 1" class="form-control p-0 border-0" wire:model="line1">
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Line 2</label>
								<div class="col-md-12 border-bottom p-0">
									<input type="text" placeholder="Enter Line 2" class="form-control p-0 border-0" wire:model="line2">
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">City</label>
								<div class="col-md-12 border-bottom p-0">
									<input type="text" placeholder="Enter City" class="form-control p-0 border-0" wire:model="city">
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-sm-12">Country</label>
								<div class="col-sm-12 border-bottom">
									<select class="form-select shadow-none p-0 border-0 form-control-line" wire:model="country_id" wire:ignore>
										<option value="">Select Country</option>
										@foreach ($countries as $country)
											<option value="{{ $country->id }}">{{ $country->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-sm-12">Province</label>
								<div class="col-sm-12 border-bottom">
									<select class="form-select shadow-none p-0 border-0 form-control-line" wire:model="province_id" wire:ignore>
										<option value="">Select Province</option>
										@foreach ($provinces as $province)
											<option value="{{ $province->id }}">{{ $province->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group mb-4">
								<label class="col-md-12 p-0">Zipcode</label>
								<div class="col-md-12 border-bottom p-0">
									<input type="text" placeholder="Enter Zipcode" class="form-control p-0 border-0" wire:model="zipcode">
								</div>
							</div>
							<div class="form-group mb-4">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success">Update Profile</button>
								</div>
							</div>
						</form>
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
