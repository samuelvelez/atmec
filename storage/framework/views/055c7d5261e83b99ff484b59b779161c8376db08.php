<table class="table table-striped table-hover table-sm data-table">
    <?php if($actions): ?>
        <caption id="signal_groups_count">
            <?php echo e(trans('signal-groups.signal-groups-table.caption', ['groupstotal' => $groupstotal])); ?>

        </caption>
    <?php endif; ?>

    <thead class="thead">
    <tr>
        <th><?php echo trans('signal-groups.signal-groups-table.id'); ?></th>
        <th><?php echo trans('signal-groups.signal-groups-table.code'); ?></th>
        <th><?php echo trans('signal-groups.signal-groups-table.name'); ?></th>
        <th><?php echo trans('signal-groups.signal-groups-table.subgroups'); ?></th>
        <th style="width: 40%;" class="hidden-xs"><?php echo trans('signal-groups.signal-groups-table.description'); ?></th>

        <?php if($actions): ?>
            <th><?php echo trans('signal-groups.signal-groups-table.actions'); ?></th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="groups_table">
    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><a href="<?php echo e(URL::to('signal-groups/' . $group->id)); ?>" target="_blank"><?php echo e($group->id); ?></td>
            <td><?php echo e($group->code); ?></td>
            <td class="hidden-xs"><?php echo e($group->name); ?></td>
            <td class="hidden-xs"><?php echo e($group->subgroups()->count()); ?></td>
            <td class="hidden-xs"><?php echo e($group->description); ?></td>

            <?php if($actions): ?>
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="<?php echo e(URL::to('signal-groups/' . $group->id)); ?>"
                       data-toggle="tooltip" title="Mostrar">
                        <?php echo trans('signal-groups.buttons.show'); ?>

                    </a>
                </td>

                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="<?php echo e(URL::to('signal-groups/' . $group->id . '/edit')); ?>"
                       data-toggle="tooltip" title="Editar">
                        <?php echo trans('signal-groups.buttons.edit'); ?>

                    </a>
                </td>

                <td>
                    <?php echo Form::open(array('url' => 'signal-groups/' . $group->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('signal-groups.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('signal-groups.modals.delete_signal_group_title'), 'data-message' => trans('signal-groups.modals.delete_signal_group_message', ['id' => $group->id]))); ?>

                    <?php echo Form::close(); ?>

                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

    <?php if(config('atm_app.enableSearch')): ?>
        <tbody id="search_results"></tbody>
    <?php endif; ?>
</table><?php /**PATH /home/atmdeveqadoor/resources/views/signal-groups/table.blade.php ENDPATH**/ ?>