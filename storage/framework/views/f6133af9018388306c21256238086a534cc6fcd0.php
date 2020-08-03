<table class="table table-striped table-sm data-table">
    <?php if($actions): ?>
        <caption id="traffic_poles_count">
            <?php echo e(trans('traffic-poles.traffic-poles-table.caption', ['polescount' => $poles->count(), 'polestotal' => $polestotal])); ?>

        </caption>
    <?php endif; ?>

    <thead class="thead">
    <tr>
        <th><?php echo trans('traffic-poles.traffic-poles-table.id'); ?></th>
        <th><?php echo trans('traffic-poles.traffic-poles-table.intersection'); ?></th>
        <th><?php echo trans('traffic-poles.traffic-poles-table.height'); ?></th>
        <th class="hidden-xs"><?php echo trans('traffic-poles.traffic-poles-table.state'); ?></th>
        <th class="hidden-xs"><?php echo trans('traffic-poles.traffic-poles-table.material'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('traffic-poles.traffic-poles-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="traffic_poles_table">
    <?php $__currentLoopData = $poles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('traffic-poles/' . $pole->id)); ?>" target="_blank"><?php echo e($pole->id); ?></a></td>
            <td><?php echo e($pole->intersection->main_st); ?> y <?php echo e($pole->intersection->cross_st); ?></td>
            <td><?php echo e($pole->height); ?>m</td>
            <td class="hidden-xs"><?php echo e($pole->state); ?></td>
            <td class="hidden-xs"><?php echo e($pole->material); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('traffic-poles/' . $pole->id)); ?>"
                       data-toggle="tooltip" title="Mostrar">
                        <?php echo trans('traffic-poles.buttons.show'); ?>

                    </a>
                </td>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('traffic-poles/' . $pole->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Editar">
                        <?php echo trans('traffic-poles.buttons.edit'); ?>

                    </a>
                </td>
                <?php endif; ?>
                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                <td>
                    <?php echo Form::open(array('url' => 'traffic-poles/' . $pole->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('traffic-poles.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar poste', 'data-message' => '¿Está seguro que desea eliminar el poste? ¡Eliminará con el todas sus dependencias!')); ?>

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
</table><?php /**PATH /home/atmeccom/resources/views/traffic-poles/traffic-poles-table.blade.php ENDPATH**/ ?>