<?php $__env->startSection('template_title'); ?>
    <?php echo trans('signalsinventory.showing-signals-inventory-title', ['code' => $vsignal->code]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .signal-image {
    height: 100px;
    width: auto;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('signalsinventory.showing-signals-inventory-title', ['code' => $vsignal->code]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('signals-inventory.index')); ?>"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('signalsinventory.tooltips.back-signals-inventories')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('signalsinventory.buttons.back-to-signals-inventories'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="<?php if($vsignal->picture_fn): ?> col-sm-6 col-md-6 <?php else: ?> col-sm-12 col-md-12 <?php endif; ?>">
                                <img src="<?php if($vsignal->picture): ?> <?php echo e(asset('storage/inventory/signals/'. $vsignal->picture)); ?> <?php else: ?> No picture <?php endif; ?>"
                                     alt="<?php echo e($vsignal->picture); ?>"
                                     class="center-block mb-3 mt-4 signal-image">
                            </div>
                            <?php if($vsignal->picture_fn): ?>
                                <div class="col-sm-6 col-md-6">
                                    <img src="<?php if($vsignal->picture): ?> <?php echo e(asset('storage/inventory/signals/'. $vsignal->picture_fn)); ?> <?php else: ?> No picture <?php endif; ?>"
                                         alt="<?php echo e($vsignal->picture_fn); ?>"
                                         class="center-block mb-3 mt-4 signal-image">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelCode')); ?>

                                </strong>
                                <?php if($vsignal->code): ?> <?php echo e($vsignal->code); ?> <?php else: ?> Sin código <?php endif; ?>
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelName')); ?>

                                </strong>
                                <?php if($vsignal->name): ?> <?php echo e($vsignal->name); ?> <?php else: ?> Sin nombre <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelGroup')); ?>

                                </strong>
                                <?php if($vsignal->subgroup): ?> <?php echo e($vsignal->subgroup->group->name . ' (' . $vsignal->subgroup->group->code . ')'); ?> <?php else: ?>
                                    Sin grupo <?php endif; ?>
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelName')); ?>

                                </strong>
                                <?php if($vsignal->subgroup): ?> <?php echo e($vsignal->subgroup->name . ' (' . $vsignal->subgroup->group->code . ')'); ?> <?php else: ?>
                                    Sin subgrupo <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelVariation')); ?>

                                </strong>
                                <?php if($vsignal->variations): ?>
                                    <table class="table table-sm table-hover">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Dimensiones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $vsignal->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($variation->variation); ?></td>
                                                <td><?php echo e($variation->signal_dimension->value); ?> <?php if($variation->signal_dimension->value_fn): ?>  <?php echo e(' - ' . $variation->signal_dimension->value_fn); ?> <?php endif; ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelErpCode')); ?>

                                </strong>
                                <?php if($vsignal->erp_code): ?> <?php echo e($vsignal->erp_code); ?> <?php else: ?> Sin código del ERP <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelUsage')); ?>

                                </strong>
                                <?php if($vsignal->usage): ?> <?php echo e($vsignal->usage); ?> <?php else: ?> Sin modo de uso <?php endif; ?>
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelDescription')); ?>

                                </strong>
                                <?php if($vsignal->description ): ?> <?php echo e($vsignal->description); ?> <?php else: ?> Sin descripción <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelCreatedAt')); ?>

                                </strong>
                                <?php if($vsignal->created_at): ?> <?php echo e($vsignal->created_at); ?> <?php else: ?> Sin fecha <?php endif; ?>
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('signalsinventory.labelUpdatedAt')); ?>

                                </strong>
                                <?php if($vsignal->updated_at): ?> <?php echo e($vsignal->updated_at); ?> <?php else: ?> Sin fecha <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/signals-inventory/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs">Nuevo tipo de señal</span></a>
                            </div>
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="<?php echo e(URL::to('signals-inventory/' . $vsignal->id . '/edit')); ?>"><i
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
                                           href="<?php echo e(URL::to('/vertical-signals/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva señal</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/intersections/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva intersección</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/signalsinventory/show-signal-inventory.blade.php ENDPATH**/ ?>