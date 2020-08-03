<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        <?php echo Form::open(['route' => 'search-regulator-devices', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_regulator_devices']); ?>

            <?php echo csrf_field(); ?>

            <div class="input-group mb-3">
                <?php echo Form::text('regulator_device_search_box', NULL, ['id' => 'regulator_device_search_box', 'class' => 'form-control', 'placeholder' => trans('regulator-devices.search.search-regulator-devices-ph'), 'aria-label' => trans('regulator-devices.search.search-regulator-devices-ph'), 'required' => false]); ?>

                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="<?php echo e(trans('regulator-devices.tooltips.clear-search')); ?>" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            <?php echo trans('regulator-devices.tooltips.clear-search'); ?>

                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('regulator-devices.tooltips.submit-search')); ?>" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            <?php echo trans('regulator-devices.tooltips.submit-search'); ?>

                        </span>
                    </a>
                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH /home/atmeccom/resources/views/partials/search-regulator-devices-form.blade.php ENDPATH**/ ?>