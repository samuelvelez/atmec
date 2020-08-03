<?php $__env->startSection('template_title'); ?>
    <?php echo trans('ito-templates.showing-template-title', ['id' => $template->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('ito-templates.showing-template-title', ['id' => $template->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('ito-templates.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('ito-templates.tooltips.back-templates')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('ito-templates.buttons.back-to-templates'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <?php if($template->name): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('ito-templates.labelName')); ?>

                                    </strong>
                                    <?php echo e($template->name); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($template->description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('ito-templates.labelDescription')); ?>

                                    </strong>
                                    <?php echo e($template->description); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($template->materials): ?>
                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <br>
                                    <div class="text-larger text-center"><strong>Listado de materiales</strong></div>
                                    <table class="table table-hover table-striped table-sm data-table">
                                        <thead class="thead">
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Unidad de medida</th>
                                        <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $template->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($material->material->name); ?></td>
                                                <td><?php echo e($material->code); ?></td>
                                                <td><?php echo e($material->metric_unit->name . ' (' . $material->metric_unit->abbreviation . ')'); ?></td>
                                                <td><?php echo e($material->amount); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="2">Sin materiales asignados aun.</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($template->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('ito-templates.labelCreated')); ?>

                                    </strong>
                                    <?php echo e($template->created_at); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($template->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('ito-templates.labelUpdated')); ?>

                                    </strong>
                                    <?php echo e($template->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/ito-templates/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva plantilla</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="<?php echo e(URL::to('ito-templates/' . $template->id . '/edit')); ?>"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/itorders/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva OET</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/ito-templates/show.blade.php ENDPATH**/ ?>