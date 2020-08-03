

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-lights.audit.auditing-traffic-light', ['id' => $light->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header text-white bg-danger">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('traffic-lights.audit.auditing-traffic-light-title', ['id' => $light->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(URL::to('traffic-lights/')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.tooltips.back-traffic-lights')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-lights.buttons.back-to-traffic-light'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover table-sm data-table">
                                    <thead class="thead">
                                    <tr>
                                        <th><?php echo trans('traffic-lights.audit.audits-table.event'); ?></th>
                                        <th><?php echo trans('traffic-lights.audit.audits-table.report'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="regulator_boxes_table">
                                    <?php $__empty_1 = true; $__currentLoopData = $audits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <?php echo app('translator')->getFromJson('traffic-lights.audit.'.$audit->event.'.metadata', $audit->getMetadata()); ?>

                                                <ul>
                                                    <?php $__currentLoopData = $audit->getModified(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $modified): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo app('translator')->getFromJson('traffic-lights.audit.'.$audit->event.'.modified.'.$attribute, $modified); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <?php if($audit->tags): ?>
                                                    <a href="<?php echo e(URL::to('reportes/' . Illuminate\Support\Str::after($audit->tags, 'report_'))); ?>"
                                                       class="btn btn-danger btn-sm"
                                                       data-toggle="tooltip" data-placement="left"
                                                       title="Ver reporte"
                                                       target="_blank"
                                                    >
                                                        <i class="fa fa-fw fa-archive" aria-hidden="true"></i>
                                                        <span class="hidden-xs">Ver reporte</span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p><?php echo app('translator')->getFromJson('traffic-lights.audit.unavailable_audits'); ?></p>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/traffic-lights/audit-traffic-light.blade.php ENDPATH**/ ?>