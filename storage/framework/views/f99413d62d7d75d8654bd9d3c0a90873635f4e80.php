<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-signals-tab" data-toggle="pill" href="#pills-signals" role="tab"
                   aria-controls="pills-signals" aria-selected="true">Señales verticales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-lights-tab" data-toggle="pill" href="#pills-lights" role="tab"
                   aria-controls="pills-lights" aria-selected="false">Semáforos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-regulators-tab" data-toggle="pill" href="#pills-regulators" role="tab"
                   aria-controls="pills-regulators" aria-selected="false">Reguladoras</a>
            </li>
        </ul>
        <hr>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-signals" role="tabpanel"
                 aria-labelledby="pills-signals-tab">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::open(array('id' => 'vsignal-filters', 'route' => 'vsignal-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_parish', trans('forms.create_vsignal_label_parish'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_parish" id="s_parish">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_parish')); ?></option>
                                        <?php if($parishs): ?>
                                            <?php $__currentLoopData = $parishs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parroquia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(strtoupper($parroquia)); ?>" ><?php echo e($parroquia); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_orientation', trans('forms.create_vsignal_label_orientation'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_orientation" id="s_orientation">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_orientation')); ?></option>
                                        <?php if($orientations): ?>
                                            <?php $__currentLoopData = $orientations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($sector); ?>" <?php echo e(old('s_orientation') == $sector ? 'selected' : ''); ?>><?php echo e($sector); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_street', trans('forms.create_label_street'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_street" id="s_street">
                                        <option value=""><?php echo e(trans('forms.create_ph_street')); ?></option>
                                        <?php if($all_vst): ?>
                                            <?php $__currentLoopData = $all_vst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $street): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($street->street); ?>" <?php echo e(old('s_street') == $street->street ? 'selected' : ''); ?>><?php echo e($street->street); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_group', trans('forms.create_vsignal_label_group'), array('class' => 'control-label'));; ?></strong>
                                    
                                    <select name="s_group" id="s_group">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_group')); ?></option>
                                        <?php if($groups): ?>
                                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($grupo->code); ?>" <?php echo e(old('s_group') == $grupo->code ? 'selected' : ''); ?>><?php echo e($grupo->name); ?> (<?php echo e($grupo->code); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_type', trans('forms.create_vsignal_label_inventory'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_type" id="s_type">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_inventory')); ?></option>
                                        <?php if($inventories): ?>
                                            <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($inventory->id); ?>" <?php echo e(old('s_type') == $inventory->id ? 'selected' : ''); ?>><?php echo e($inventory->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_state" id="s_state">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('s_state') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_material', trans('forms.create_vsignal_label_material'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_material" id="s_material">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_material')); ?></option>
                                        <?php if($materials): ?>
                                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('s_material') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('s_fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'control-label'));; ?></strong>
                                    <select name="s_fastener" id="s_fastener">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_fastener')); ?></option>
                                        <?php if($s_fasteners): ?>
                                            <?php $__currentLoopData = $s_fasteners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('s_fastener') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-lights" role="tabpanel" aria-labelledby="pills-lights-tab">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::open(array('id' => 'light-filters', 'route' => 'light-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('l_street', trans('forms.create_label_street'), array('class' => 'control-label'));; ?></strong>
                                    <select name="l_street" id="l_street">
                                        <option value=""><?php echo e(trans('forms.create_ph_street')); ?></option>
                                        <?php if($all_lst): ?>
                                            <?php $__currentLoopData = $all_lst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $street): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($street->street); ?>" <?php echo e(old('l_street') == $street->street ? 'selected' : ''); ?>><?php echo e($street->street); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('l_type', trans('forms.create_traffic_light_label_light_type'), array('class' => 'control-label'));; ?></strong>
                                    <select name="l_type" id="l_type">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_light_type')); ?></option>
                                        <?php if($light_types): ?>
                                            <?php $__currentLoopData = $light_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type->id); ?>" <?php echo e(old('l_type') == $type->id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('l_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label'));; ?></strong>
                                    <select name="l_state" id="l_state">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('l_state') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('l_brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'control-label'));; ?></strong>
                                    <select name="l_brand" id="l_brand">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_brand')); ?></option>
                                        <?php if($ligth_brands): ?>
                                            <?php $__currentLoopData = $ligth_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('l_brand') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('l_fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'control-label'));; ?></strong>
                                    <select name="l_fastener" id="l_fastener">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_fastener')); ?></option>
                                        <?php if($l_fasteners): ?>
                                            <?php $__currentLoopData = $l_fasteners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('l_fastener') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-regulators" role="tabpanel" aria-labelledby="pills-regulators-tab">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::open(array('id' => 'regulator-filters', 'route' => 'regulator-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('r_street', trans('forms.create_label_street'), array('class' => 'control-label'));; ?></strong>
                                    <select name="r_street" id="r_street">
                                        <option value=""><?php echo e(trans('forms.create_ph_street')); ?></option>
                                        <?php if($all_lst): ?>
                                            <?php $__currentLoopData = $all_lst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $street): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($street->street); ?>" <?php echo e(old('r_street') == $street->street ? 'selected' : ''); ?>><?php echo e($street->street); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('r_brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'control-label'));; ?></strong>
                                    <select name="r_brand" id="r_brand">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_brand')); ?></option>
                                        <?php if($regulator_brands): ?>
                                            <?php $__currentLoopData = $regulator_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('r_brand') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong><?php echo Form::label('r_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label'));; ?></strong>
                                    <select name="r_state" id="r_state">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('r_state') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>


        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php echo Form::button('<i class="fa fa-fw fa-filter" aria-hidden="true"></i> ' . trans('forms.filter_button_text'), array('class' => 'btn btn-sm btn-primary margin-bottom-1 mb-1 ml-1 float-right','type' => 'button', 'id' => 'filter-submit')); ?>&nbsp;&nbsp;
                <?php echo Form::button('<i class="fa fa-fw fa-undo" aria-hidden="true"></i> ' . trans('forms.clear_button_text'), array('class' => 'btn btn-sm btn-secondary margin-bottom-1 mb-1 float-right','type' => 'reset', 'id' => 'filter-reset')); ?>

            </div>
        </div>
    </div>
</div><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/georeports/filters/geo-filter.blade.php ENDPATH**/ ?>