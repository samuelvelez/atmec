<?php $__env->startSection('template_title'); ?>
    <?php echo trans('workorders.showing-workorder-title', ['id' => $workorder->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('workorders.showing-workorder-title', ['id' => $workorder->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('workorders.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('workorders.tooltips.back-workorders')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('workorders.buttons.back-to-workorders'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <?php if($workorder->report->alert->collector): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelAlertCollector')); ?>

                                    </strong>
                                    <?php echo e($workorder->report->alert->collector->full_name()); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($workorder->collector): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelOrderCollector')); ?>

                                    </strong>
                                    <?php echo e($workorder->collector->full_name()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($workorder->report->alert->description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelAlertDescription')); ?>

                                    </strong>
                                    <?php echo e($workorder->report->alert->description); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($workorder->report->description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelReportDescription')); ?>

                                    </strong>
                                    <?php echo e($workorder->report->description); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($workorder->report->alert->description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelOrderDescription')); ?>

                                    </strong>
                                    <?php echo e($workorder->description); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($workorder->complete_description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelCompletedDescription')); ?>

                                    </strong>
                                    <?php echo e($workorder->complete_description); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($workorder->status): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelStatus')); ?>

                                    </strong>
                                    <?php echo e($workorder->status->name); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($workorder->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelCreated')); ?>

                                    </strong>
                                    <?php echo e($workorder->created_at); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($workorder->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('workorders.labelUpdated')); ?>

                                    </strong>
                                    <?php echo e($workorder->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('workorders.labelStarted')); ?>

                                </strong>
                                <?php if($workorder->started_on): ?>
                                    <?php echo e($workorder->started_on); ?>

                                <?php else: ?>
                                    No iniciada
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('workorders.labelCompleted')); ?>

                                </strong>
                                <?php if($workorder->completed_on): ?>
                                    <?php echo e($workorder->completed_on); ?>

                                <?php else: ?>
                                    No comletada
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <?php if(Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_OPEN): ?>
                            <br/>
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="<?php echo e(URL::to('workorders/' . $workorder->id . '/edit')); ?>"><i
                                                class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                </div>
                            </div>
                        <?php endif; ?>
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

    <?php if(config('settings.googleMapsAPIStatus')): ?>
        <?php echo $__env->make('scripts.google-maps-atm-show', [
            'latitude' => $workorder->latitude,
            'longitude' => $workorder->longitude,
            'code' => $workorder->id,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/workorders/show.blade.php ENDPATH**/ ?>