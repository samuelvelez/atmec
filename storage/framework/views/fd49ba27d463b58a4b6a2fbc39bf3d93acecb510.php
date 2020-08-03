<table class="table table-sm data-table table-hover">
    <thead class="thead-dark">
    <tr>
        <th><?php echo trans('georeports.totals.criteria'); ?></th>
        <th><?php echo trans('georeports.totals.value'); ?></th>
    </tr>
    </thead>
    <tbody id="totals_table">
    <tr class="table-active">
        <td><strong><?php echo trans('georeports.totals.state'); ?></strong></td>
        <td></td>
    </tr>

    <?php $__currentLoopData = $state_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="pl-4"><?php echo $state; ?></td>
            <td><?php echo e($total); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr class="table-active">
        <td><strong><?php echo trans('georeports.totals.brand'); ?></strong></td>
        <td></td>
    </tr>

    <?php $__currentLoopData = $material_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="pl-4"><?php echo $material; ?></td>
            <td><?php echo e($total); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr class="table-active">
        <td><strong><?php echo trans('georeports.light-totals.type'); ?></strong></td>
        <td></td>
    </tr>

    <?php $__currentLoopData = $type_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="pl-4"><?php echo ucfirst(mb_strtolower($type)); ?></td>
            <td><?php echo e($total); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr class="table-success">
        <td><strong><?php echo trans('georeports.light-totals.general'); ?></strong></td>
        <td><strong><?php echo e($light_total); ?></strong></td>
    </tr>
    </tbody>
</table><?php /**PATH /home/atmdeveqadoor/resources/views/georeports/tables/light-totals-table.blade.php ENDPATH**/ ?>