<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        <?php echo Form::open(['route' => 'search-vertical-signals', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_vsignals']); ?>

            <?php echo csrf_field(); ?>

            <div class="input-group mb-3">
                <?php echo Form::text('vsignal_search_box', NULL, ['id' => 'vsignal_search_box', 'class' => 'form-control', 'placeholder' => trans('verticalsignals.search.search-vsignals-ph'), 'aria-label' => trans('verticalsignals.search.search-vsignals-ph'), 'required' => false]); ?>

                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="<?php echo e(trans('verticalsignals.tooltips.clear-search')); ?>" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            <?php echo trans('verticalsignals.tooltips.clear-search'); ?>

                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('verticalsignals.tooltips.submit-search')); ?>" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            <?php echo trans('verticalsignals.tooltips.submit-search'); ?>

                        </span>
                    </a>
                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH /home/atmeccom/resources/views/partials/search-vsignals-form.blade.php ENDPATH**/ ?>