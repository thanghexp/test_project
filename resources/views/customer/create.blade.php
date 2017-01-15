@extends('layouts/base')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-@if( !empty($edit_data) ) edit @else plus-circle @endif margin-r-5 text-primary"></i>{{$page_title}}</h3>
			</div>
			<form role="form" method="POST">
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">

							@if( !empty($edit_data) )
							<input type="hidden" name="id" value="{{$data_customer.id}}">
							@endif

							<div class="form-group">
								<label>Status<span class="text-danger">※</span></label>
								<select id="status" class="form-control select2" name="status">
									@foreach($customer_status AS $status)
									<option value="{{ $status['code'] }}" @if(isset($data_customer.status) && $data_customer.status == $status.code)   selected @endif >{{ $status['value'] }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>取引先種別<span class="text-danger">※</span></label>
								<select name="type[]" class="form-control select2" multiple="multiple" id="type" data-placeholder="取引先種別を選択してください">
									<!--{foreach from=$customer_types item=type}-->
									<option value="<!--{$type.code|escape}-->" <!--{if isset($data_customer.type) && in_array($type.code, $data_customer.type)}-->selected<!--{/if}-->><!--{$type.value|escape|default:''}--></option>
									<!--{/foreach}-->
								</select>
							</div>

							<div class="form-group">
								<label>Name Customer</label>
								<input id="name" name="name" type="text"
									   class="form-control"
									   value="<!--{$data_customer.name|escape|default:''}-->"
									   placeholder="取引先名を入力してください">
							</div>
							<div class="form-group">
								<label>Postal Code</label>
								<input id="postal_code" name="postal_code" type="text"
									   class="form-control"
									   value="<!--{$data_customer.postal_code|escape|default:''}-->"
									   placeholder="郵便番号をハイフン無しで入力してください">
							</div>
							<!--{if empty($edit_data)}-->
							</div>
						<div class="col-md-6">
						<!--{/if}-->
							<div class="form-group">
								<label>Address</label>
								<input id="address" name="address" type="text"
									   class="form-control"
									   value="<!--{$data_customer.address|escape|default:''}-->"
									   placeholder="住所をすべて入力してください">
							</div>
							<!--{if !empty($edit_data)}-->
						</div>
						<div class="col-md-6">
						<!--{/if}-->

							<div class="form-group">
								<label>Phone Number</label>
								<input id="phone_number" name="phone_number" type="text"
									   class="form-control"
									   value="<!--{$data_customer.phone_number|escape|default:''}-->"
									   placeholder="電話番号を入力してください">
							</div>
							<div class="form-group">
								<label>FAX Number</label>
								<input id="fax_number" name="fax_number" type="text"
									   class="form-control"
									   value="<!--{$data_customer.fax_number|escape|default:''}-->"
									   placeholder="FAX番号を入力してください">
							</div>
							<div class="form-group">
								<label>Bill Type</label>
								<select id="bill_type" name="bill_type" class="form-control select2">
									<option value="">支払請求種別を選択してください</option>
									<!--{foreach from=$bill_types item=build}-->
									<option value="<!--{$build.code|escape}-->" <!--{if isset($data_customer.bill_type) && $data_customer.bill_type == $build.code}-->selected<!--{/if}-->><!--{$build.value|escape|default:''}--></option>
									<!--{/foreach}-->
								</select>
							</div>
							<!--{if !empty($edit_data)}-->
							<div class="form-group">
								<label>Main Charge Name</label>
								<select id="main_charge" class="form-control select2" name="main_charge">
									<option value="0">主担当者名を選択してください</option>
									<!--{foreach from=$customer_contacts item=contact}-->
									<option value="<!--{$contact.id|escape}-->" <!--{if isset($data_customer.main_charge) && $data_customer.main_charge == $contact.id}-->selected<!--{/if}-->><!--{$contact.name|escape}--></option>
									<!--{/foreach}-->
								</select>
							</div>
							<div class="form-group">
								<label>Secondary contact name</label>
								<select id="extra_charge" class="form-control select2" name="extra_charge">
									<option value="0">副担当者名を選択してください</option>
									<!--{foreach from=$customer_contacts item=contact}-->
									<option value="<!--{$contact.id|escape}-->" <!--{if isset($data_customer.extra_charge) && $data_customer.extra_charge == $contact.id}-->selected<!--{/if}-->><!--{$contact.name|escape}--></option>
									<!--{/foreach}-->
								</select>
							</div>
							<!--{/if}-->

							<div class="form-group">
								<label>テクシス担当者名</label>
								<select id="account" class="form-control select2" name="account_id">
									<option value="">環境テクシスの担当者名を選択してください</option>
									<!--{foreach from=$accounts item=account}-->
									<option value="<!--{$account.id|escape}-->" <!--{if isset($data_customer.account_id) && $data_customer.account_id == $account.id}-->selected<!--{/if}-->><!--{$account.name|escape}--></option>
									<!--{/foreach}-->
								</select>
							</div>

						</div>
						<div class="col-md-12">
							<div class="form-group">
							<label>Remark</label>
							<textarea id="remark" name="remark" class="form-control"
									  rows="5"
									  placeholder="備考情報があれば登録してください"><!--{$data_customer.remark|escape|default:''}--></textarea>
						</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-2">
							<a id="x-button-cancel" href="/customer/<!--{$data_customer.id|default:''}-->" class="btn btn-block btn-default"><b><i class="fa fa-ban margin-r-5"></i>Cancel</b></a>
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