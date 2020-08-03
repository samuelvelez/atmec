<table class="table table-striped table-hover table-sm data-table">
    <?php if($actions): ?>
        <caption id="signal_subgroups_count">
            <?php echo e(trans('signal-subgroups.signal-subgroups-table.caption', ['subgroupstotal' => $subgroupstotal])); ?>

        </caption>
    <?php endif; ?>

    <thead class="thead">
    <tr>
        <th><?php echo trans('signal-subgroups.signal-subgroups-table.id'); ?></th>
        <th><?php echo trans('signal-subgroups.signal-subgroups-table.code'); ?></th>
        <th style="width: 10%;"><?php echo trans('signal-subgroups.signal-subgroups-table.name'); ?></th>
        <th class="hidden-xs"><?php echo trans('signal-subgroups.signal-subgroups-table.shape'); ?></th>
        <?php if($actions): ?>
            <th><?php echo trans('signal-subgroups.signal-subgroups-table.group'); ?></th>
        <?php endif; ?>
        <th style="width: 40%;"
            class="hidden-xs"><?php echo trans('signal-subgroups.signal-subgroups-table.description'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('signal-subgroups.signal-subgroups-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="groups_table">
    <?php $__currentLoopData = $subgroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('signal-subgroups/' . $subgroup->id)); ?>" target="_blank"><?php echo e($subgroup->id); ?></td>
            <td><?php echo e($subgroup->code); ?></td>
            <td><?php echo e($subgroup->name); ?></td>
            <td class="hidden-xs"><?php echo e($subgroup->shape); ?></td>
            <?php if($actions): ?>
                <td><?php echo e($subgroup->group->name); ?></td>
            <?php endif; ?>
            <td class="hidden-xs"><?php echo e($subgroup->description); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('signal-subgroups/' . $subgroup->id)); ?>"
                       data-toggle="tooltip" title="Mostrar">
                        <?php echo trans('signal-subgroups.buttons.show'); ?>

                    </a>
                </td>

                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('signal-subgroups/' . $subgroup->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Editar">
                        <?php echo trans('signal-subgroups.buttons.edit'); ?>

                    </a>
                </td>

                <td>
                    <?php echo Form::open(array('url' => 'signal-subgroups/' . $subgroup->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('signal-subgroups.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('signal-subgroups.modals.delete_signal_subgroup_title'), 'data-message' => trans('signal-subgroups.modals.delete_signal_subgroup_message', ['id' => $subgroup->id]))); ?>

                    <?php echo Form::close(); ?>

                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php if(config('atm_app.enableSearch')): ?>
        <tbody id="search_results"></tbody>
    <?php endif; ?>
</table><?php /**PATH /home/atmdeveqadoor/resources/views/signal-subgroups/table.blade.php ENDPATH**/ ?>