<!-- Content Wrapper. Contains page content -->
<div class="page-wrapper bg-secondary">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Tast</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						@if (Auth::user()->hasRole('admin'))
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@elseif(Route::has('login'))
							<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@endif
						<li class="breadcrumb-item active"><a href="{{ route('user.task') }}" class="fw-normal ">Task</a>
						</li>
					</ol>
					{{-- <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank"
                                class="btn btn-danger btn-sm   d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
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
				<div class="white-box shadow">
					<div class="row mb-2">
						<div class="col d-flex align-items-center">
							<h3 class="box-title">Task List</h3>
						</div>
						<div class="col">
							<a href="{{ route('user.addtask') }}" class="btn btn-success float-end">
								<i class="fas fa-plus-circle mr-2"></i>
								Create New Task
							</a>
						</div>

					</div>
					{{-- List Task Start --}}
					<div class="row row-cols-1 row-cols-md-4 g-1 card-group mb-3">
						@foreach ($tasks as $task)
							<div class="col border">
								<div class="card @if ($task->status) bg-success @elseif($task->priority) bg-danger  @else bg-warning @endif" style="min-width: 14rem; height: 100%">
									<img src="{{ asset('assets/images/task') }}/{{ $task->cover_image }}" class="card-img-top" alt="...">
									<div class="card-header d-flex align-items-center @if ($task->priority && !$task->status) text-light @endif" style="min-height: 50px;">
										<h5 class="card-title"><b>{{ $task->title }}</b></h5>
									</div>
									<div class="card-body @if ($task->priority && !$task->status) text-light @endif">
										<p class="card-text">{{ $task->short_description }}</p>
									</div>
									<div class="card-footer">
										<ul class="list-group list-group-flush mb-2">
											<li class="list-group-item bg-transparent  @if ($task->priority && !$task->status) text-light @endif">
												<div class="d-flex w-100 justify-content-between">
													<b>Status :</b>
													<span>
														@if ($task->status)
															Completed
														@else
															Ongoing
														@endif
													</span>
												</div>
											</li>
											<li class="list-group-item bg-transparent @if ($task->priority && !$task->status) text-light @endif">
												<div class="d-flex w-100 justify-content-between">
													<b>Priority :</b>
													<span>
														@if ($task->priority)
															Yes
														@else
															No
														@endif
													</span>
												</div>
											</li>
											<li class="list-group-item bg-transparent @if ($task->priority && !$task->status) text-light @endif">
												<div class="d-flex w-100 justify-content-between">
													<b>Date :</b>
													<span>{{ Carbon\Carbon::parse($task->created_at)->format('m/d/Y') }}</span>
												</div>
											</li>
										</ul>
										<div class="col mb-3">
											<a href="{{ route('user.viewtask', ['task_slug' => $task->slug]) }}" class="btn btn-info   text-light"
												style="width: 100%;"><i class="fas fa-dot-circle mr-2"></i> Preview</a>
											<a href="{{ route('user.edittask', ['task_id' => $task->id]) }}" class="btn btn-primary   text-light"
												style="width: 100%;"><i class="fas fa-edit mr-2"></i> Edit</a>
											<a href="#" class="@if ($task->priority && !$task->status) btn btn-dark @else btn btn-danger @endif   text-light" style="width: 100%;"
												onclick="confirm('Are you sure, You want to delete this Task?') || event.stopImmediatePropagation()"
												wire:click.prevent="deleteTask({{ $task->id }})"><i class="fas fa-trash mr-2"></i> Delete</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach

					</div>
					{{-- List Task End --}}
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
