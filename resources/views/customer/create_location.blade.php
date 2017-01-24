@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-<!--{if !empty($edit_data)}-->edit<!--{else}-->plus-circle<!--{/if}--> margin-r-5 text-primary"></i>拠点情報</h3>
            </div>
            <form role="form" class="" action="{{ url('customer/save_location')  }}" method="POST">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="customer_id" value="{{ $customer_id  }}">

                            <div class="form-group">
                                <label>Status<span class="text-danger">※</span></label>
                                <select class="form-control select2" id="status" name="status">
                                    @foreach($location_status as $status)
                                        <option value="{{ $status['code'] }}" @if(isset($data_location['status']) && $data_location['status'] == $status['code'] ) selected @endif>{{ $status['code'] or '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('status')) <p>{{ $errors->first('status') }}</p> @endif

                            <div class="form-group">
                                <label>Name website<span class="text-danger">※</span></label>
                                <input type="text" class="form-control"
                                       id="site_name"
                                       name="site_name"
                                       value="{{ old('site_name', !empty($data_location['site_name']) ? $data_location['site_name'] : null ) }}"
                                       placeholder="Please enter the base name">
                            </div>
                            @if($errors->has('site_name')) <p>{{ $errors->first('site_name') }}</p> @endif

                            <div class="form-group">
                                <label>Postal code</label>
                                <input type="text" class="form-control"
                                       id="postal_code"
                                       name="postal_code"
                                       value="{{ old('postal_code', !empty($data_location['postal_code']) ? $data_location['postal_code'] : null ) }}"
                                       placeholder="Please enter zip code without hyphen">
                            </div>
                            @if($errors->has('postal_code')) <p>{{ $errors->first('postal_code') }}</p> @endif

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control"
                                       id="address"
                                       name="address"
                                       value="{{ old('address', !empty($data_location['address']) ? $data_location['address'] : null ) }}"
                                       placeholder="Please enter all your address">
                            </div>
                            @if($errors->has('address')) <p>{{ $errors->first('address') }}</p> @endif

                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" class="form-control"
                                       id="phone_number"
                                       name="phone_number"
                                       value="{{ old('phone_number', !empty($data_location['phone_number']) ? $data_location['phone_number'] : null ) }}"
                                       placeholder="Please enter phone number">
                            </div>
                            @if($errors->has('phone_number')) <p>{{ $errors->first('phone_number') }}</p> @endif

                            <div class="form-group">
                                <label>Fax number</label>
                                <input type="text" class="form-control"
                                       id="fax_number"
                                       name="fax_number"
                                       value="{{ old('fax_number', !empty($data_location['fax_number']) ? $data_location['fax_number'] : null ) }}"
                                       placeholder="Please enter fax。">
                            </div>
                            @if($errors->has('fax_number')) <p>{{ $errors->first('fax_number') }}</p> @endif

                            <div class="form-group">
                                <label>Main charge</label>
                                <select class="form-control select2" id="main_charge" name="main_charge">
                                    <option value="">Please choose main charge name</option>
                                    @foreach($customer_contacts AS $contact)
                                        <option value="{{ $contact['id'] }}" @if( old('main_charge', isset($data_location['main_charge']) ? $data_location['main_charge'] : null ) == $contact['id'] ) selected @endif>{{ $contact['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('main_charge')) <p>{{ $errors->first('main_charge') }}</p> @endif

                            <div class="form-group">
                                <label>Extra charge</label>
                                <select class="form-control select2" id="extra_charge" name="extra_charge">
                                    <option value="">Please choose person secondary reponsility</option>
                                    @foreach($customer_contacts AS $contact)
                                        <option value="{{ $contact['id'] }}" @if( old('extra_charge', isset($data_location['extra_charge']) ? $data_location['extra_charge'] : null ) == $contact['id'] ) selected @endif>{{ $contact['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('extra_charge')) <p>{{ $errors->first('extra_charge') }}</p> @endif

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product info</label>
                                <input type="text" class="form-control"
                                       id="product_info"
                                       name="product_info"
                                       value="{{ old('product_info', !empty($data_location['product_info']) ? $data_location['product_info'] : null ) }}"
                                       placeholder="Please enter handling product information
">
                            </div>
                            @if($errors->has('product_info')) <p>{{ $errors->first('product_info') }}</p> @endif

                            <div class="form-group">
                                <label>Consumption</label>
                                <input type="text" class="form-control"
                                       id="consumption"
                                       name="consumption"
                                       value="{{ old('consumption', !empty($data_location['consumption']) ? $data_location['consumption'] : null ) }}"
                                       placeholder="Please input amount generated or consumption">
                            </div>
                            @if($errors->has('consumption')) <p>{{ $errors->first('consumption') }}</p> @endif

                            <div class="form-group">
                                <label>Trading unit price</label>
                                <input type="text" class="form-control"
                                       id="trading_unit_price"
                                       name="trading_unit_price"
                                       value="{{ old('trading_unit_price', !empty($data_location['trading_unit_price']) ? $data_location['trading_unit_price'] : null) }}"
                                       placeholder="Please enter current transaction unit price">
                            </div>
                            @if($errors->has('trading_unit_price')) <p>{{ $errors->first('trading_unit_price') }}</p> @endif

                            <div class="form-group">
                                <label>Forklift</label>
                                <input type="text" class="form-control"
                                       id="forklift"
                                       name="forklift"
                                       value="{{ old('forklift', !empty($data_location['forklift']) ? $data_location['forklift'] : null) }}"
                                       placeholder="Please enter the presence or absence of a forklift">
                            </div>
                            @if($errors->has('forklift')) <p>{{ $errors->first('forklift') }}</p> @endif

                            <div class="form-group">
                                <label>Remark</label>
                                <textarea class="form-control"
                                          rows="8"
                                          id="remark"
                                          name="remark"
                                          placeholder="Remarks Please register if there is information">{{ old('remark', !empty($data_location['remark']) ? $data_location['remark'] : null) }}</textarea>
                            </div>
                            @if($errors->has('remark')) <p>{{ $errors->first('remark') }}</p> @endif

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                   <div class="row">
                       <div class="col-md-3 col-sm-4 col-xs-6 col-md-offset-3 col-sm-offset-2">
                           <a id="x-button-cancel" href="/customer/{{ $customer_id }}" class="btn btn-block btn-default"><b><i class="fa fa-ban margin-r-5"></i>Cancel</b></a>
                       </div>
                       <div class="col-md-3 col-sm-4 col-xs-6">
                           <button type="submit" class="btn btn-block btn-primary"><b><i class="fa fa-save margin-r-5"></i>Save</b></button>
                       </div>
                   </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection