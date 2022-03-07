<div class="page-wrapper">
	<div class="page-breadcrumb bg-white">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Province Edit</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<div class="d-md-flex">
					<ol class="breadcrumb ms-auto">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="fw-normal">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.province') }}" class="fw-normal ">Province</a></li>
						<li class="breadcrumb-item active"><a href="#" class="fw-normal ">Edit</a></li>
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
							<h5><i class="icon fas fa-check"></i> Province Added!</h5>{{ Session::get('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="row">
						<div class="col">
							<h3 class="box-title">Province Entry</h3>
						</div>
						<div class="col"><a href="{{ route('admin.province') }}" class="btn btn-primary float-end"><i
									class="fas fa-list mr-2"></i> All Provinces</a> </div>
					</div>
					<!-- form start -->
					<form wire:submit.prevent="updateProvince" class="form-horzontal form-material">
						<div class="card-body">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
									placeholder="Enter Country" wire:model="name">
								@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>
                            <div class="form-group">
                                <label for="name">Select Country</label>
                                <div class="border-bottom">
                                    <select class="form-select @error('country_id') is-invalid @enderror" wire:model="country_id">
                                        <option value="0">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
						</div>
						<button type="submit" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i> Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
