<div class="page-wrapper">
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Task Entry</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						@if(Auth::user()->hasRole('admin'))							
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@elseif(Route::has('login'))
							<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="fw-normal">Dashboard</a></li>
						@endif
						<li class="breadcrumb-item"><a href="{{ route('user.task') }}" class="fw-normal ">Task</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('user.addtask') }}" class="fw-normal">Add</a></li>
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
			<div class="col-md-8 col-sm-8">
				<div class="white-box">
					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> New Task Created!</h5>{{ Session::get('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="row">
						<div class="col">
							<h3 class="box-title">Task Entry</h3>
						</div>
						<div class="col"><a href="{{ route('user.task') }}" class="btn btn-primary float-end"><i
									class="fas fa-list mr-2"></i> All Tasks</a> </div>
					</div>
					<!-- form start -->
					<form wire:submit.prevent="addTask" class="form-horzontal form-material">
						<div class="card-body">
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
									placeholder="Enter Title" wire:model="title">
								@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
                            <div class="form-group">
								<label for="short_description">Short Description</label>
								<input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description"
									placeholder="Enter Short Description" wire:model="short_description">
								@error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
                            <div class="form-group">
                                <label for="priority">Status</label>
                                <div class="border-bottom">
                                    <select class="form-select @error('status') is-invalid @enderror" wire:model="status">
                                        <option value="0">On-going</option>
                                        <option value="1">Completed</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <div class="border-bottom">
                                    <select class="form-select @error('priority') is-invalid @enderror" wire:model="priority">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">                               
								<label class="col-md-12 p-0">Cover Image</label>
								<div class="col-md-12   p-0">
									<input type="file" class="custom-file-input form-control" wire:model="cover_image" wire:ignore>
								</div>
								<div class="col-md-12 p-0">
									@if ($cover_image)
										<img src="{{ $cover_image->temporaryUrl() }}" alt="" width="120">
									@endif
								</div>
                                @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
                            <div class="form-group mb-4">
								<label class="col-md-12 p-0">Gallery</label>
								<div class="col-md-12   p-0">
									<input type="file" class="custom-file-input form-control @error('gallery') is-invalid @enderror" id="inputGroupFile05" wire:model="gallery" multiple>
								</div>
								<div class="col-md-12 p-0">
									 @if($gallery)
                                        @foreach($gallery as $image)
                                            <img src="{{$image->temporaryUrl()}}" width="120" alt="">
                                        @endforeach
                                    @endif
								</div>
                                @error('gallery')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
							<div class="card">
								<div class="card-header">
									Products
								</div>
	
								<div class="card-body">
									<table class="table" id="products_table">
										<thead>
											<tr>
												<th>#</th>
												<th>Description</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($subTasks as $index => $subTask)
												<tr>
													
													<td>
														<input type="number" name="subTasks[{{ $index }}][no]" class="form-control"
															wire:model="subTasks.{{ $index }}.no" />
													</td>
													<td>
														<input type="text" name="subTasks[{{ $index }}][description]" class="form-control"
															wire:model="subTasks.{{ $index }}.description" />
													</td>
													<td>
														<select name="subTasks[{{ $index }}][status]"
															wire:model="subTasks.{{ $index }}.status" class="form-control form-select">
															<option value="0">Not Done</option>
															<option value="1">Done</option>
														</select>
													</td>
													<td>
														<a href="#" wire:click.prevent="removeSubTask({{ $index }})" class="btn btn-danger text-light">Delete</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
	
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-sm btn-secondary" wire:click.prevent="addSubTask">+ Add Another Product</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i> Submit</button>
					</form>
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
