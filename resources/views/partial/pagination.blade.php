 @if( !empty($pagination['total']) )
<div class="row">
    <div class="col-sm-6 col-xs-12 pull-right">
        @if ($pagination['per_page'] > 1)
            <ul class="pagination pagination-sm pull-right">
                <li class="{{ ($pagination['current_page'] == 1) ? ' disabled' : '' }}">
                    <a href="{{ !empty($pagination['prev_page']) ? url()->current() . $pagination['prev_page'] : 'javascript:;' }}">Previous</a>
                </li>
                @for ($i = 1; $i < $pagination['per_page']; $i++)
                    <li class="{{ ($pagination['current_page'] == $i) ? ' active' : '' }}">
                        <a href="{{ url()->current() . '?page=' . $i  }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($pagination['current_page'] == $pagination['per_page']) ? ' disabled' : '' }}">
                    <a href="{{ !empty($pagination['next_page']) ? url()->current() . $pagination['next_page'] : 'javascript:;'  }}" >Next</a>
                </li> 
            </ul>
        @endif
    </div>
</div>
@endif