<td>
    <label>
        <input type="checkbox"
               name="{{ $definition_data['code'] or '' }}"
               data-id="{{ $data_id or '' }}"
               data-type="{{ $definition_data['type'] or '' }}"
               data-code="{{ $definition_data['code'] or '' }}"
               data-status="{{ $definition_data['status'] or '' }}"
               class="flat-red x-checkbox-change-status"
        @if(isset($admin) && empty($admin)) disabled @endif

        @if( $definition_data['status'] == 1 || $definition_data['status'] == 3 )checked @endif>

    </label>
</td>