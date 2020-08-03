<table class="table table-striped table-sm data-table">
    <?php if($actions): ?>
        <caption id="regulator_devices_count">
            <?php echo e(trans('regulator-devices.regulator-devices-table.caption', ['devicescount' => $devices->count(), 'devicestotal' => $devicestotal])); ?>

        </caption>
    <?php endif; ?>
    <thead class="thead">
    <tr>
        <th><?php echo trans('regulator-devices.regulator-devices-table.id'); ?></th>
        <th><?php echo trans('regulator-devices.regulator-devices-table.code'); ?></th>
        <th><?php echo trans('regulator-devices.regulator-devices-table.regulator'); ?></th>
        <th><?php echo trans('regulator-devices.regulator-devices-table.state'); ?></th>
        <th><?php echo trans('regulator-devices.regulator-devices-table.type'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-devices.regulator-devices-table.brand'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-devices.regulator-devices-table.model'); ?></th>
        <th class="hidden-xs"><?php echo trans('regulator-devices.regulator-devices-table.erp-code'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('regulator-devices.regulator-devices-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="regulator_devices_table">
    <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('regulator-devices/' . $device->id)); ?>" target="_blank"><?php echo e($device->id); ?></td>
            <td><?php echo e($device->code); ?></td>
            <td><?php echo e($device->regulator_box->code); ?></td>
            <td><?php echo e($device->state); ?></td>
            <td>
                <?php if($device->type): ?>
                    <div class="col-sm-6 col-6">
                        <?php if($device->type == "ups_brands"): ?>
                            <span class="badge-pill badge badge-info">UPS</span>
                        <?php endif; ?>

                        <?php if($device->type == "energy_brands"): ?>
                            <span class="badge-pill badge badge-danger">Fuente de poder</span>
                        <?php endif; ?>

                        <?php if($device->type == "mmu_brands"): ?>
                            <span class="badge-pill badge badge-primary">MMU</span>
                        <?php endif; ?>

                        <?php if($device->type == "travel_brands"): ?>
                            <span class="badge-pill badge badge-success">Velocidad de viaje</span>
                        <?php endif; ?>

                        <?php if($device->type == "controller_brands"): ?>
                            <span class="badge-pill badge badge-warning">Controlador</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </td>
            <td class="hidden-xs"><?php echo e($device->brand); ?></td>
            <td class="hidden-xs"><?php echo e($device->model); ?></td>
            <td class="hidden-xs"><?php echo e($device->erp_code); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('regulator-devices/' . $device->id)); ?>"
                       data-toggle="tooltip" title="Mostrar">
                        <?php echo trans('regulator-devices.buttons.show'); ?>

                    </a>
                </td>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('regulator-devices/' . $device->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Editar">
                        <?php echo trans('regulator-devices.buttons.edit'); ?>

                    </a>
                </td>
                <?php endif; ?>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                <td>
                    <?php echo Form::open(array('url' => 'regulator-devices/' . $device->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('regulator-devices.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar dispositivo', 'data-message' => '¿Está seguro que desea eliminar el dispositivo? ¡Eliminará con él todas sus dependencias!')); ?>

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

</table><?php /**PATH /home/atmeccom/resources/views/regulator-devices/regulator-devices-table.blade.php ENDPATH**/ ?>