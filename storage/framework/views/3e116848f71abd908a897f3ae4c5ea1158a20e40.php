<table class="table table-striped table-sm data-table">
    <?php if($actions): ?>
        <caption id="traffic_lights_count">
            <?php echo e(trans('traffic-lights.traffic-lights-table.caption', ['lightscount' => $lights->count(), 'lightstotal' => $lightstotal])); ?>

        </caption>
    <?php endif; ?>

    <thead class="thead">
    <tr>
        <th><?php echo trans('traffic-lights.traffic-lights-table.id'); ?></th>
        <th><?php echo trans('traffic-lights.traffic-lights-table.intersection'); ?></th>
        <th class="hidden-xs"><?php echo trans('traffic-lights.traffic-lights-table.brand'); ?></th>
        <th class="hidden-xs"><?php echo trans('traffic-lights.traffic-lights-table.model'); ?></th>
        <th class="hidden-xs"><?php echo trans('traffic-lights.traffic-lights-table.state'); ?></th>
        <th><?php echo trans('traffic-lights.traffic-lights-table.orientation'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('traffic-lights.traffic-lights-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="traffic_lights_table">
    <?php $__currentLoopData = $lights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $light): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('traffic-lights/' . $light->id)); ?>" target="_blank"><?php echo e($light->id); ?></td>
            <td><?php echo e($light->intersection->main_st); ?> y <?php echo e($light->intersection->cross_st); ?></td>
            <td class="hidden-xs"><?php echo e($light->brand); ?></td>
            <td class="hidden-xs"><?php echo e($light->model); ?></td>
            <td class="hidden-xs"><?php echo e($light->state); ?></td>
            <td><?php echo e($light->orientation); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('traffic-lights/' . $light->id)); ?>"
                       data-toggle="tooltip" title="Mostrar">
                        <?php echo trans('traffic-lights.buttons.show'); ?>

                    </a>
                </td>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('traffic-lights/' . $light->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Editar">
                        <?php echo trans('traffic-lights.buttons.edit'); ?>

                    </a>
                </td>
                <?php endif; ?>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                <td>
                    <?php echo Form::open(array('url' => 'traffic-lights/' . $light->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('traffic-lights.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar semáforo', 'data-message' => '¿Está seguro que desea eliminar el semáforo? ¡Eliminará con el todas sus dependencias!')); ?>

                    <?php echo Form::close(); ?>

                </td>
                <?php endif; ?>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php if(config('atm_app.enableSearch')): ?>
        <tbody id="search_results"></tbody>
    <?php endif; ?>
</table><?php /**PATH /home/atmdeveqadoor/resources/views/traffic-lights/traffic-lights-table.blade.php ENDPATH**/ ?>