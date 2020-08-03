<?php $__env->startSection('template_title'); ?>
    <?php echo trans('reports.showing-report-title', ['id' => $report->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .picture {
    height: 400px;
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
                            <?php echo trans('reports.showing-report-title', ['id' => $report->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('reports.tooltips.back-reports')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('reports.buttons.back-to-reports'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Alerta:
                                </strong>
                                <?php echo e($report->alert->id); ?>

                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Tipo de Trabajo:
                                </strong>
                                <?php echo e($report->worktype->name); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Novedad:
                                </strong>
                                <?php echo e($report->novelty->name); ?>

                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Subnovedad:
                                </strong>
                                <?php echo e($report->subnovelty->name); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Estado:
                                </strong>
                                <?php echo e($report->status->name); ?>

                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Descripción:
                                </strong>
                                <?php echo e($report->description); ?>

                            </div>
                        </div>

                        <?php if($report->pictures): ?>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="text-center"><strong>Imagenes asociadas</strong></div>

                                    <div id="pictures-carousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <?php $__currentLoopData = json_decode($report->pictures); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li data-target="#carouselExampleIndicators"
                                                    data-slide-to="<?php echo e($loop->index); ?>"
                                                    class="<?php if($loop->first): ?> active <?php endif; ?>"></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ol>

                                        <div class="carousel-inner">
                                            <?php $__currentLoopData = json_decode($report->pictures); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="carousel-item text-center <?php if($loop->first): ?> active <?php endif; ?>">
                                                    <img class="picture"
                                                         src="<?php echo e(asset('storage/reports/' . $picture)); ?>"
                                                         alt="Imagen <?php echo e($loop->iteration); ?>">
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#pictures-carousel" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Anterior</span>
                                        </a>
                                        <a class="carousel-control-next" href="#pictures-carousel" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Siguiente</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="text-center"><strong>Dispositivos afectados</strong></div>
                                <table class="table table-striped table-sm data-table">
                                    <thead class="thead">
                                    <tr>
                                        <th>Tipos de dispositivos</th>
                                        <th>Elementos</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Señales verticales</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->vertical_signals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('vertical-signals/' . $signal->id)); ?>"
                                                   data-toggle="tooltip" title="Ir a señal: <?php echo e($signal->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($signal->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cajas reguladoras</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->regulator_boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regulator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('regulator-boxes/' . $regulator->id)); ?>"
                                                   data-toggle="tooltip"
                                                   title="Ir a reguladora: <?php echo e($regulator->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($regulator->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dispositivos de caja</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->traffic_devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('regulator-devices/' . $item->id)); ?>"
                                                   data-toggle="tooltip"
                                                   title="Ir al dispositivo: <?php echo e($item->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($item->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Postes de tráfico</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->traffic_poles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('traffic-poles/' . $item->id)); ?>"
                                                   data-toggle="tooltip" title="Ir al poste: <?php echo e($item->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($item->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tensores</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->traffic_tensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('traffic-tensors/' . $item->id)); ?>"
                                                   data-toggle="tooltip" title="Ir al tensor: <?php echo e($item->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($item->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Semáforos</td>
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $report->traffic_lights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <a href="<?php echo e(URL::to('traffic-lights/' . $item->id)); ?>"
                                                   data-toggle="tooltip" title="Ir al semáforo: <?php echo e($item->id); ?>"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger"><?php echo e($item->id); ?></span>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php if($report->materials): ?>
                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <br>
                                    <div class="text-larger text-center"><strong>Listado de materiales
                                            requeridos</strong>
                                    </div>
                                    <table class="table table-hover table-striped table-sm data-table">
                                        <thead class="thead">
                                        <th>Nombre</th>
                                        <th>Unidad de medida</th>
                                        <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $report->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($material->material->name); ?></td>
                                                <td><?php echo e($material->metric_unit->name . ' (' . $material->metric_unit->abbreviation . ')'); ?></td>
                                                <td><?php echo e($material->amount); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="2">Sin materiales asignados aun.</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($report->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('reports.labelCreated')); ?>

                                    </strong>
                                    <?php echo e($report->created_at); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($report->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('reports.labelUpdated')); ?>

                                    </strong>
                                    <?php echo e($report->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <?php if(Auth::user()->hasRole('atmcollector') && $report->workorder): ?>
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="<?php echo e(URL::to('reports/' . $report->id . '/edit')); ?>"><i
                                                class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/reports/show.blade.php ENDPATH**/ ?>