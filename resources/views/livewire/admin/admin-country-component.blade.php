<!-- Content Wrapper. Contains page content -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Country</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Home</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('admin.country') }}" class="fw-normal ">Country</a>
						</li>
					</ol>
					{{-- <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                                to Pro</a> --}}
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->

	<!-- Main content -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> Country Added!</h5>{{ Session::get('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					@if (Session::has('del_message'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> Country Deleted!</h5>{{ Session::get('del_message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					@if (Session::has('up_message'))
						<div class="alert alert-info alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> Country Updated!</h5>{{ Session::get('up_message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="row">
						<div class="col">
							<h3 class="box-title">Country</h3>
						</div>
						<div class="col"><a href="{{ route('admin.addcountry') }}" class="btn btn-success float-end"><i
									class="fas fa-plus-circle mr-2"></i> Add
								New</a> </div>

					</div>

					{{-- <p class="text-muted">Add class <code>.table</code></p> --}}

					<div class="table-responsive">

						<table class="table text-nowrap table-hover">
							<thead>
								<tr>
									<th class="border-top-0">#</th>
									<th class="border-top-0">Name</th>
									<th class="border-top-0">Date</th>
									<th class="border-top-0">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($countries as $country)
									<tr>
										<td>{{ $country->id }}</td>
										<td>{{ $country->name }}</td>
										<td>{{ $country->created_at }}</td>
										<td>
											<a href="{{ route('admin.editcountry', ['country_id' => $country->id]) }}"
												class="btn btn-primary btn-sm text-light"><i class="fas fa-edit mr-2"></i> Edit</a>
											<a href="#" class="btn btn-danger btn-sm text-light"
												onclick="confirm('Are you sure, You want to delete this country?') || event.stopImmediatePropagation()"
												wire:click.prevent="deleteCountry({{ $country->id }})"><i class="fas fa-trash mr-2"></i> Delete</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content-wrapper -->
