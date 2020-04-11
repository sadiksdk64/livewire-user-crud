<div class="container">
    
    @if (session('message'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span>{{ session('message') }}</span><br/>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            {{ Form::open(['url' => 'payment-accounts', 'method' => 'post','wire:submit.prevent' => 'submit']) }}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        {{ Form::label('name', 'Name : *',['class' => 'col-md-4','align' => 'right'])}}
                        <div class="col-md-6">
                            {{ Form::text('name', null,['class' => 'form-control','placeholder' => 'Enter Name','wire:model' => 'name']) }}
                            @error('name') <span class="error text-danger"">{{ $message }}</span> @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', 'Email : *',['class' => 'col-md-4','align' => 'right'])}}
                        <div class="col-md-6">
                            {{ Form::text('email', '',['class' => 'form-control','placeholder' => 'name@example.com','wire:model' => 'email']) }}
                            @error('email') <span class="error text-danger"">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', 'DOB : *',['class' => 'col-md-4','align' => 'right'])}}
                        <div class="col-md-6">
                            {{Form::date("dob", null,  ['class' => 'form-control','placeholder' => 'Date Of Birth','wire:model' => "dob"])}}
                            @error('dob') <span class="error text-danger"">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>  
                <div class="col-sm-6">
                    <div class="form-group row">
                        {{ Form::label('name', 'Mobile :',['class' => 'col-md-4','align' => 'right'])}}
                        <div class="col-md-6">
                            {{ Form::text('mobile', '',['class' => 'form-control','placeholder' => 'Enter Mobile No','wire:model' => 'mobile']) }}
                            @error('mobile') <span class="error text-danger"">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', 'Country : *',['class' => 'col-md-4','align' => 'right'])}}
                        <div class="col-md-6">
                            {{ Form::text('country', '',['class' => 'form-control','placeholder' => 'Select Country','wire:model' => 'country']) }}
                            @error('country') <span class="error text-danger"">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', 'Gender : *',['class' => 'col-md-4','align' => 'right'])}}
                    
                        <div class="col-md-6" >
                            <div class="row">
                            <div class="col-md-3" >
                            {{Form::radio('gender', 0,$gender,['class' => 'form-control','wire:model' => 'gender'])}} Male
                            </div>
                            <div class="col-md-4" >
                            {{Form::radio('gender', 1,$gender,['class' => 'form-control','wire:model' => 'gender'])}} FeMale
                            </div>
                            </div>
                            <div>
                            @error('gender') <span class="error text-danger"">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                    </div>
                </div>


                <div class="col-md-12">
                    @if($route == 'index')
                        <button type="submit" class="btn btn-success" style="display: block; margin: 0 auto">Save</button>
                    @elseif($route == 'edit')
                    <div class="text-center">
                        <a href="#" class="btn btn-success"  wire:click="updatemodel()">Update</a>
                    </div>
                    @endif
                </div>
                {{ Form::close() }}
        </div>
        </div>
    </div>
    
    @if($route == 'index')
    <br>
    <div class="card card-body">
		<div class="col-sm-12">
            @error('delete') <div class="alert alert-danger"> <span class="error">{{ $message }}</span> </div> @enderror
			<div class="">
					<div class="row table-header-section">
						<div class="col-sm-6">
                            List Of Users:
						</div>
						  <div class="col-sm-6 table-search">
						  </div>
						</div>
				<div class="table-responsive mt-2">
					<table class="table table-striped table-outer-border no-margin user-list-table table-sm" id="user-table" style="width:100%">

						<thead>
							<th class="td-text">#</th>
							<th class="td-text">Name</th>
							<th class="td-text">Email</th>
							<th class="td-text">DOB</th>
							<th class="td-text">Mobile</th>
							
							<th class="text-right">Actions</th>
						</thead>
						@if(count($users) > 0)
				    		@foreach($users as $index => $user)
								<tr>
									<td class="td-text">
										{{ $index + 1 }}
									</td>
									<td class="td-text">
										{{$user['name'] ?? ''}}
									</td>
									<td class="td-text">
										{{$user['email'] ?? ''}}
									</td>
									<td class="td-text" >
                                        {{$user['dob']}}
									</td>
									<td class="td-text">
										{{$user['mobile']}}
									</td>
									<td class="text-right">
										<a href="#" wire:click="edit({{$user['id']}})" class="btn btn-warning waves-effect waves-light btn-sm" style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Setting"><i class="fas fa-cog">Edit</i></a>
										<a href="#" wire:click="delete({{$user['id']}})" class="btn btn-danger waves-effect waves-light btn-sm" style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Setting"><i class="fas fa-cog">Delete</i></a>
									</td>
								</tr>
							@endforeach
				    	@else
			    		<tr>
			    			<td colspan="6" class="text-center">No results found.</td>
			    		</tr>
			    		@endif
			   		</table>
				   </div>
			</div>
		</div>
    </div>
    @endif



</div>
