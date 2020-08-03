<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        {!! Form::open(['route' => 'search-device-inventory', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_device']) !!}
            {!! csrf_field() !!}
            <div class="input-group mb-3">
                {!! Form::text('device_search_box', NULL, ['id' => 'device_search_box', 'class' => 'form-control', 'placeholder' => trans('device-inventory.search.search-device-inventories-ph'), 'aria-label' => trans('device-inventory.search.search-device-inventories-ph'), 'required' => false]) !!}
                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="{{ trans('device-inventory.tooltips.clear-search') }}" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!! trans('device-inventory.tooltips.clear-search') !!}
                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('device-inventory.tooltips.submit-search') }}" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!!  trans('device-inventory.tooltips.submit-search') !!}
                        </span>
                    </a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
