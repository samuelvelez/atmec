<?php $__env->startSection('template_title'); ?>
    <?php echo trans('signal-groups.showing-signal-group', ['id' => $group->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('signal-groups.showing-signal-group-title', ['id' => $group->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('signal-groups.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('signal-groups.tooltips.back-signal-groups')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('signal-groups.buttons.back-to-signal-groups'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <?php if($group->code): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('signal-groups.show-signal-group.code')); ?>

                                    </strong>
                                    <?php echo e($group->code); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($group->name): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('signal-groups.show-signal-group.name')); ?>

                                    </strong>
                                    <?php echo e($group->name); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <?php if($group->description): ?>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        <?php echo e(trans('signal-groups.show-signal-group.description')); ?>

                                    </strong>
                                </div>
                            </div><div class="row">
                                <div class="col-sm-12 col-12">
                                    <?php echo e($group->description); ?>

                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        <?php endif; ?>

                        <div class="row">
                            <?php if($group->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo trans('signal-groups.show-signal-group.created'); ?>

                                    </strong>
                                    <?php echo e($group->created_at); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($group->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo trans('signal-groups.show-signal-group.updated'); ?>

                                    </strong>
                                    <?php echo e($group->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Subgrupos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('signal-subgroups.table', [
                                'subgroups' => $group->subgroups()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/signal-groups/show.blade.php ENDPATH**/ ?>