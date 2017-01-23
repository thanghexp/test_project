@extends('layouts/base')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-@if( !empty($edit_data) ) edit @else plus-circle @endif margin-r-5 text-primary"></i>{{$page_title}}</h3>
			</div>
			<form role="form" action="/customer/store" method="POST">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if( !empty($edit_data) )
								<input type="hidden" name="id" value="{{ $data_customer['id'] }}">
							@endif

							<div class="form-group">
								<label>Status<span class="text-danger">※</span></label>
								<select id="status" class="form-control select2" name="status">
									@foreach($customer_status AS $status)
										<option value="{{ $status['code'] }}" @if(old('status', !empty($data_customer['status']) ? $data_customer['status'] : '') == $status) selected @endif >{{ $status['code'] }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('status')) <p>{{ $errors->login->first('status') }}</p> @endif

							<div class="form-group">
								<label>Take The Lead Type<span class="text-danger">※</span></label>
								<select name="type[]" class="form-control select2" multiple="multiple" id="type" data-placeholder="Please select the business partner type">
									@foreach( $customer_types AS $type )
										<option value="{{$type['code']}}" @if( !empty(old('type')) || in_array($type['code'], !empty($data_customer['type']) ? $data_customer['type'] : []) ) selected @endif>{{ $type['code'] }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('type')) <p class="error">{{ $errors->first('type') }}</p> @endif

							<div class="form-group">
								<label>Name Customer</label>
								<input id="name" name="name" type="text"
									   class="form-control"
									   value="{{ old('name', !empty($data_customer['name']) ? $data_customer['name'] : '') }}"
									   placeholder="Please enter the business partner name">
							</div>
							@if($errors->has('name')) <p class="error">{{$errors->first('name')}}</p>@endif

							<div class="form-group">
								<label>Postal Code</label>
								<input id="postal_code" name="postal_code" type="text"
									   class="form-control"
									   value="{{  old('postal_code', !empty($data_customer['postal_code']) ? $data_customer['postal_code'] : NULL) }}"
									   placeholder="Please enter zip code without hyphen">
							</div>
							@if($errors->has('postal_code')) <p class="error">{{$errors->first('postal_code')}}</p>@endif

							<!--{if empty($edit_data)}-->
							</div>
						<div class="col-md-6">
						<!--{/if}-->
							<div class="form-group">
								<label>Address</label>
								<input id="address" name="address" type="text"
									   class="form-control"
									   value="{{ old('address', !empty($data_customer['address']) ? $data_customer['address'] : NULL) }}"
									   placeholder="Please enter all your address">
							</div>
							@if($errors->has('address')) <p>{{ $errors->first('address') }}</p> @endif
							<!--{if !empty($edit_data)}-->
						</div>
						<div class="col-md-6">
						<!--{/if}-->

							<div class="form-group">
								<label>Phone Number</label>
								<input id="phone_number" name="phone_number" type="text"
									   class="form-control"
									   value="{{  old('phone_number', !empty($data_customer['phone_number']) ? $data_customer['phone_number'] : NULL) }}"
									   placeholder="Please enter phone number">
							</div>
							@if($errors->has('phone_number')) <p>{{ $errors->first('phone_number') }}</p> @endif

							<div class="form-group">
								<label>FAX Number</label>
								<input id="fax_number" name="fax_number" type="text"
									   class="form-control"
									   value="{{ old('fax_number', !empty($data_customer['fax_number']) ? $data_customer['fax_number'] : NULL) }}"
									   placeholder="Please enter fax number">
							</div>
							@if($errors->has('fax_number')) <p>{{ $errors->first('fax_number') }}</p> @endif

							<div class="form-group">
								<label>Bill Type</label>
								<select id="bill_type" name="bill_type" class="form-control select2">
									<option value="">Please select the payment request type</option>
									@foreach( $customer_bill_types AS $build )
										<option value="{{ $build['value'] }}" @if(old('bill_type', !empty($data_customer['bill_type']) ? $data_customer['bill_type'] : NULL) == $build['value'] ) selected @endif>{{ $build['value'] }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('bill_type')) <p>{{ $errors->first('bill_type') }}</p> @endif

							@if(!empty($edit_data))
								<div class="form-group">
									<label>Main Charge Name</label>
									<select id="main_charge" class="form-control select2" name="main_charge">
										<option value="0">Please select primary contact name</option>
										@foreach($customer_contacts AS $contact)
											<option value="{{ $contact['id'] }}" @if(old('main_charge', !empty($data_customer['main_charge']) ? $data_customer['main_charge'] : NULL) == $contact['id'] )selected @endif>{{ $contact['name'] }}</option>
										@endforeach
									</select>
								</div>
								@if($errors->has('main_charge')) <p>{{ $errors->first('main_charge') }}</p> @endif

								<div class="form-group">
									<label>Secondary Contact Name</label>
									<select id="extra_charge" class="form-control select2" name="extra_charge">
										<option value="0">Please select the name of the secondary representative</option>
										@foreach($customer_contacts AS $contact)
											<option value="{{  $contact['id'] }}" @if (old('extra_charge', !empty($data_customer['extra_charge']) ? $data_customer['extra_charge'] : NULL) == $contact['id']) selected @endif>{{ $contact['name'] }}</option>
										@endforeach
									</select>
								</div>
								@if($errors->has('extra_charge')) <p>{{ $errors->first('extra_charge') }}</p> @endif
							@endif

							<div class="form-group">
								<label>Name Of Person In Charge Of Texis</label>
								<select id="account" class="form-control select2" name="account_id">
									<option value="">Please select the name of the person in charge of environmental texis</option>
									@foreach($accounts AS $account)
										<option value="{{  $account['id'] }}" @if(old('account_id', !empty($data_customer['account_id']) ? $data_customer['account_id'] : NULL) == $account['id']) selected @endif>{{  $account['name'] }}</option>$a
									@endforeach
								</select>
							</div>
							@if($errors->has('account_id')) <p>{{ $errors->first('account_id') }}</p> @endif

						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Remark</label>
								<textarea id="remark" name="remark" class="form-control"
										  rows="5"
										  placeholder="Remarks Please register if there is information">{{ (old('remark', !empty($data_customer['remark']) ? $data_customer['remark'] : NULL)) }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-2">
							<a id="x-button-cancel" href="/customer/{{$data_customer['id'] or ''}}" class="btn btn-block btn-default"><b><i class="fa fa-ban margin-r-5"></i>Cancel</b></a>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-6">
							<button type="submit" class="btn btn-block btn-primary"><b><i class="fa fa-save margin-r-5"></i>Register</b></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection