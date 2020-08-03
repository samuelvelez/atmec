<?php $__env->startSection('template_title'); ?>
    <?php echo trans('workorders.closing-workorder', ['id' => $workorder->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('workorders.closing-workorder', ['id' => $workorder->id]); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('workorders.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('workorders.tooltips.back-workorders')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('workorders.buttons.back-to-workorders'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('url' => 'workorders/' . $workorder->id . '/close', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-md-12">
                                <p>Adjunte las fotos de los cambios realizados. Si es necesario realice algunas precisiones.</p>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('pictures') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('pictures', 'Fotos', array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::file('pictures', array('id' => 'pictures', 'name' => 'pictures[]', 'placeholder' => 'Adjunte las fotos', 'multiple' => true)); ?>

                                </div>
                                <?php if($errors->has('pictures')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('pictures')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('description') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('description', trans('workorders.create_label_description'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::textarea('description', null, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => 'Detalles del cierre de orden.')); ?>

                                </div>
                                <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('description')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php echo Form::button(trans('workorders.edit_button_text'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/workorders/close.blade.php ENDPATH**/ ?>