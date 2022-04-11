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
					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> Task Updated!</h5>{{ Session::get('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="row">
						<div class="col">
							<h3 class="box-title">{{ $title }}</h3>
						</div>
						<div class="col"><a href="{{ route('user.task') }}" class="btn btn-primary float-end"><i
									class="fas fa-list mr-2"></i> All Tasks</a> </div>
					</div>

					<div class="card-body">
						<!-- form start -->
						<form wire:submit.prevent="updateTask" class="form-horzontal form-material">
							<div class="form-group mb-4">
								<label for="title"><b>Title</b></label>
								<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
									placeholder="Enter Title" wire:model="title">
								@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
							<div class="form-group mb-4">
								<label for="short_description"><b>Short Description</b></label>
								<input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description"
									name="short_description" placeholder="Enter Short Description" wire:model="short_description">
								@error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
							<div class="form-group mb-4">
								<label for="status"><b>Status</b></label>
								<div class="border-bottom">
									<select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
										wire:model="status">
										<option value="0">On-going</option>
										<option value="1">Completed</option>
									</select>
									@error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>
							</div>
							<div class="form-group mb-4">
								<label for="priority"><b>Priority</b></label>
								<div class="border-bottom">
									<select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority"
										wire:model="priority">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
									@error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>
							</div>
							<div class="form-group mb-4">
								<label for="new_cover_image" class="col-md-12 p-0"><b>Cover Image</b></label>
								<div class="col-md-12   p-0">
									<input type="file" class="custom-file-input form-control @error('new_cover_image') is-invalid @enderror"
										wire:model="new_cover_image" id="new_cover_image" name="new_cover_image" wire:ignore>
								</div>
								<div class="col-md-12 p-2 border">
									@if ($new_cover_image)
										<img class="mb-1" src="{{ $new_cover_image->temporaryUrl() }}" alt="" width="120">
									@elseif($cover_image)
										<img class="mb-1" src="{{ asset('assets/images/task') }}/{{ $cover_image }}" alt=""
											width="120">
									@endif
								</div>
								@error('new_cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
							<div class="form-group mb-4">
								<label for="new_gallery" class="col-md-12 p-0"><b>Gallery</b></label>
								<div class="col-md-12   p-0">
									<input type="file" class="custom-file-input form-control @error('new_gallery') is-invalid @enderror"
										id="new_gallery" name="new_gallery" wire:model="new_gallery" multiple>
								</div>
								<div class="col-md-12 p-2 border">
									@if ($new_gallery)
										@foreach ($new_gallery as $image)
											<img class="mb-1" src="{{ $image->temporaryUrl() }}" width="120" alt="">
										@endforeach
									@elseif($gallery)
										@foreach (explode(',', $gallery) as $image)
											@if ($image)
												<img class="mb-1" src="{{ asset('assets/images/task') }}/{{ $image }}" width="120"
													alt="">
											@endif
										@endforeach
									@endif

								</div>
								@error('new_gallery')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
							<div class="form-group mb-4">
								<button type="submit" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i> Update</button>
							</div>
						</form>
						<div class="form-group mb-4">
							@if (Session::has('sub_message'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<h5><i class="icon fas fa-check"></i> Sub-Task!</h5>{{ Session::get('sub_message') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endif
							<table class="table table-sm table-striped border ">
								<thead>
									<tr>
										<th>#</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($subtasks as $subtask)
										@if ($subtask_id != $subtask->id)
											<tr>
												<td>
													{{ $subtask->no }}
												</td>
												<td>
													{{ $subtask->description }}
												</td>
												<td>
													@if ($subtask->status == 0)
														Not Done
													@else
														Done
													@endif
												</td>
												<td>
													<!-- Button trigger modal -->
													<button type="button" class="btn btn-sm btn-primary text-light mb-1"
														wire:click.prevent="showEditSubTaskModal('{{ $subtask->id }}')">
														<i class="fas fa-edit mr-2"></i> Edit
													</button>
													<a href="#" class="btn btn-sm btn-danger text-light mb-1"
														onclick="confirm('Are you sure, You want to delete this sub-Task?') || event.stopImmediatePropagation()"
														wire:click.prevent="deleteSubTask({{ $subtask->id }})"><i class="fas fa-trash mr-2"></i> Delete</a>
												</td>
											</tr>
										@elseif($st_enabledAdd == false && $subtask_id == $subtask->id)
											<tr class="bg-secondary">
												<td>
													<div class="form-group">
														<input type="text" placeholder="Sequence no" class="form-control @error('no') is-invalid @enderror "
															wire:model.defer="no">
														@error('no')<div class="invalid-feedback">{{ $message }}</div>@enderror
													</div>
													<div class="form-group">
														<select id="st_status" name="st_status"
															class="form-control form-select @error('st_status') is-invalid @enderror " wire:model="st_status"
															value="{{ $st_status }}">
															<option value="0" @if ($st_status == 0) selected @endif>Not Done</option>
															<option value="1" @if ($st_status == 1) selected @endif>Done</option>
														</select>
														@error('st_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
													</div>
												</td>
												<td colspan="2">
													<textarea type="text" placeholder="Description"
														class="form-control @error('st_description') is-invalid @enderror "
														wire:model.defer="st_description">{{ $st_description }}</textarea>
													@error('st_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
												</td>
												{{-- <td>
													
												</td> --}}
												<td>
													<form autocomplete="off" wire:submit.prevent="updateSubTask">
														<button type="submit" class="btn btn-sm btn-success mb-1"><i class="fa fa-save mr-2"></i> Update</button>
													</form>
													<button type="button" class="btn btn-sm btn-danger text-light mb-1" wire:click.prevent="cancelEdit()"><i
															class="fas fa-window-close mr-2"></i> Cancel</button>
												</td>
											</tr>
										@endif
									@endforeach
								</tbody>
							</table>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showmodal"
										wire:click.prevent="showAddSubTaskModal()"><i class="fas fa-plus-circle"></i>
										Add Another Task</button>
								</div>
							</div>
						</div>

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
	<!-- Modal Add SubTask START -->
	<div class="modal fade" id="showmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
		wire:ignore.self>
		<div class="modal-dialog">
			<div class="modal-content bg-secondary">
				<form autocomplete="off" wire:submit.prevent="addSubTask">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					@if (Session::has('modal_message'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<h5><i class="icon fas fa-check"></i> Task Updated!</h5>{{ Session::get('modal_message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="modal-body">
						<div class="form-group">
							<label for="no" class="col-form-label"><b>No</b></label>
							<input type="text" placeholder="Sequence no" class="form-control @error('no') is-invalid @enderror "
								wire:model.defer="no">
							@error('no')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="form-group">
							<label for="st_description" class="col-form-label"><b>Description</b></label>
							<input type="text" placeholder="Description" class="form-control @error('st_description') is-invalid @enderror "
								wire:model.defer="st_description">
							@error('st_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="form-group">
							<label for="st_status" class="col-form-label"><b>Status</b></label>
							<select id="st_status" name="st_status"
								class="form-control form-select @error('st_status') is-invalid @enderror" wire:model="st_status">
								<option value="0">Not Done</option>
								<option value="1">Done</option>
							</select>
							@error('st_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info"><i class="fa fa-save mr-2"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Add SubTask END -->
</div>
