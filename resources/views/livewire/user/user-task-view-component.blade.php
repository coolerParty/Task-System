<div class="page-wrapper bg-secondary">
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Task Preview</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						@if (Auth::user()->hasRole('admin'))
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@elseif(Route::has('login'))
							<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@endif
						<li class="breadcrumb-item"><a href="{{ route('user.task') }}" class="fw-normal ">Task</a></li>
						<li class="breadcrumb-item active"><a href="#" class="fw-normal">{{ $slug }}</a></li>
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
		<div class="row">
			<!-- Column -->
			<div class="col-lg-4 col-xlg-3 col-md-12">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img width="100%" alt="user" src="{{ asset('assets/images/task') }}/{{ $cover_image }}">
						</div>
						@foreach (explode(',', $gallery) as $gal)
							@if ($gal)
								<div class="carousel-item">
									<img width="100%" alt="user" src="{{ asset('assets/images/task') }}/{{ $gal }}">
								</div>
							@endif
						@endforeach
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<!-- Column -->
			<div class="col-lg-8 col-xlg-9 col-md-12">
				<div class="white-box">
					<div class="row">
						<div class="col d-flex align-items-end">
							<h3 class="box-title">{{ $title }}</h3>
						</div>
						<div class="col"><a href="{{ route('user.task') }}" class="btn btn-primary float-end"><i
									class="fas fa-list mr-2"></i> All Tasks</a> </div>
					</div>
					<!-- form start -->
					<div class="card-body">
						<div class="form-group mb-2 border-bottom">
							<p><b>Description : </b> {{ $short_description }}</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Status : </b>
								@if ($status)
									Completed
								@else
									Ongiong
								@endif
							</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Priority : </b>
								@if ($priority)
									Yes
								@else
									No
								@endif
							</p>
						</div>
						<div class="form-group mb-2 border-bottom">
							<p><b>Date : </b> <span>{{ Carbon\Carbon::parse($date)->format('m/d/Y') }}</span></p>
						</div>
						<table class="table table-hover border">
							<thead>
								<tr>
									<th>#</th>
									<th>Description</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($subtasks as $subtask)
									<tr>
										<td>
											{{ $subtask->no }}
										</td>
										<td>
											{{ $subtask->description }}
										</td>
										<td>

											@if ($subtask->status)
												Not Done
											@else
												Done
											@endif

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
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->
		<!-- .right-sidebar -->
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
	</div>

</div>
