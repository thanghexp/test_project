@extends('layouts/base')

@section('content')
<div class="row" id="x-list-customer">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="pull-left">
					<a href="{{url('/customer/create')}}" class="btn bg-olive btn-flat"><b><i class="fa fa-plus-circle margin-r-5"></i>Register</b></a>
					<a href="javascript:;" class="btn btn-danger btn-flat x-button-delete-customer"><b><i class="fa fa-trash margin-r-5"></i>Delete</b></a>
				</div>
			</div>
			<div class="box-body">
				<div class="no-padding">

					@include('partial.searchbox', [
						'page' => 'customer',
						'pagination' => !empty($pagination) ? $pagination : '',
						'search_value' => !empty($search_value) ? $search_value : ''
					])

					 <div class="table-responsive">
						 <table class="table table-bordered table-hover">
							 <tbody class="text-center">
								 <tr class="bg-gray text-center">
									 <th class="text-center"><input type="checkbox" class="minimal checkAll" name="customer_id" value=""></th>
									 <th class="text-center">Full Name</th>
									 <th class="text-center">Status</th>
									 <th class="text-center">Address</th>
									 <th class="text-center">Phone Number</th>
									 <th class="text-center">Fax Number</th>
									 <th class="text-center">Main charge name</th>
									 <th class="text-center">Priority contact type</th>
									 <th class="text-center">Action</th>
								 </tr>

								 @if(isset($customers))
									@foreach($customers as $customer)
									 <tr>
										 <td class="check"><input type="checkbox" class="minimal check" name="customer_id" value="{{ $customer['id'] }}"></td>
										 <td class="text-left">{{ $customer['name'] or ''}}</td>
										 <td>{{ $customer['status'] }}</td>
										 <td class="text-left">{{ $customer['address'] or '' }}</td>
										 <td class="text-left">{{ $customer['phone_number'] }}</td>
										 <td class="text-left">{{ $customer['fax_number'] }}</td>
										 <td>{{ $customer['main_charge_name'] or '' }}</td>
										 <td>{{ $customer['main_charge_contact'] or '' }}</td>
										 <td><a href="/customer/{{ $customer['id'] }}" class="btn btn-info btn-flat btn-xs"><b><i class="fa fa-file-text margin-r-5"></i>Detail</b></a></td>
									 </tr>
									 @endforeach
								 @else
								 	@include('partial.list_empty', ['total_column' => 9])
								 @endif
							 </tbody>
							 <div class="x-table-overlay">
								 <div class="overlay">
									 <i class="fa fa-refresh fa-spin"></i>
								 </div>
							 </div>
						 </table>
					 </div>
					
					@include('partial/pagination', ['pagination' => !empty($pagination) ? $pagination : ''])

				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>
@stop

@section('javascript')
<script type="text/javascript" src="/js/TEXIS.CustomerList.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		new TEXIS.CustomerList({
			el: $('#x-list-customer')
		});
	});
</script>
@stop