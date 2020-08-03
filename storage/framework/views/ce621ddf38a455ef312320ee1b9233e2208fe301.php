<table class="table table-striped table-sm data-table">
    <?php if($actions): ?>
        <caption id="regulator_boxes_count">
            <?php echo e(trans('regulator-boxes.regulator-boxes-table.caption', ['rbox_count' => $regulator_boxes->count(), 'rbox_total' => $regulator_box_total])); ?>

        </caption>
    <?php endif; ?>
    <thead class="thead">
    <tr>
        <th><?php echo trans('regulator-boxes.regulator-boxes-table.id'); ?></th>
        <th><?php echo trans('regulator-boxes.regulator-boxes-table.intersection'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-boxes.regulator-boxes-table.brand'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-boxes.regulator-boxes-table.state'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-boxes.regulator-boxes-table.google_address'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('regulator-boxes.regulator-boxes-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="regulator_boxes_table">
    <?php $__currentLoopData = $regulator_boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regulator_box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('regulator-boxes/' . $regulator_box->id)); ?>"
                   target="_blank"><?php echo e($regulator_box->id); ?></a></td>
            <td><?php echo e($regulator_box->intersection->main_st); ?> y <?php echo e($regulator_box->intersection->cross_st); ?></td>
            <td class="hidden-xs"><?php echo e($regulator_box->brand); ?></td>
            <td class="hidden-xs"><?php echo e($regulator_box->state); ?></td>
            <td class="hidden-xs"><?php echo e($regulator_box->google_address); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('regulator-boxes/' . $regulator_box->id)); ?>"
                       data-toggle="tooltip" title="Show">
                        <?php echo trans('regulator-boxes.buttons.show'); ?>

                    </a>
                </td>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('regulator-boxes/' . $regulator_box->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Edit">
                        <?php echo trans('regulator-boxes.buttons.edit'); ?>

                    </a>
                </td>
                <?php endif; ?>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                <td>
                    <?php echo Form::open(array('url' => 'regulator-boxes/' . $regulator_box->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('regulator-boxes.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar caja reguladora', 'data-message' => '¿Está seguro que desea eliminar esta caja reguladora? ¡Eliminará con ella todas sus dependencias!')); ?>

                    <?php echo Form::close(); ?>

                </td>
                <?php endif; ?>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php if($actions): ?>
        <?php if(config('atm_app.enableSearch')): ?>
            <tbody id="search_results"></tbody>
        <?php endif; ?>
    <?php endif; ?>

</table><?php /**PATH /home/atmdeveqadoor/resources/views/regulator-boxes/regulators-table.blade.php ENDPATH**/ ?>