<?php

return [

    // Titles
    'showing-all-reports'     => 'Mostrando todas las entregas de materiales',
    'create-new-report'       => 'Crear nueva entrega de materiales',
    'editing-report'          => 'Editando el reporte :id',
    'showing-mt-title'    => 'Creando la entrega de materiales',
    'showing-report-title'     => 'Mostrando la entrega de materiales :id',

    // Flash Messages
    'createSuccess'   => '¡Entrega de materiales creada!',
    'createError'   => 'Error creando la Orden de retiro',
    'updateSuccess'   => '¡Orden de retiro actualizado!',
    'aprobSuccess'   => '¡Orden de retiro aprobada!',
    'entregSuccess'   => '¡Entrega de materiales recibida!',    
    'recibSuccess'   => '¡Orden de retiro recibida y finalizada!',        
    'updateError'   => 'Error actualizado la Orden de retiro',
    'deleteSuccess'   => '¡Orden de retiro eliminado!',
    'deleteError'   => 'Error eliminando la Orden de retiro',

    'reports-table' => [
        'caption'   => '{1} Existe una entrega de material.|[2,*] Cantidad total de entregas de materiales: :reportstotal.',
        'id'        => 'ID',
        'reportid'     => 'ID Orden Trabajo',
        'order'     => 'Orden de trabajo',
        'creator'     => 'Creador',
        'novelty'     => 'Novedad',
        'subnovelty'     => 'Subnovedad',
        'status'     => 'Estado',
        'worktype'     => 'Tipo de trabajo',
        'readed'     => 'Lectura',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
        'namecollector'   => 'Entregado por',
        'nameaprob'   => 'Recibido por',
    ],

    'buttons' => [
        'create_workorder'    => '<i class="fa fa-fw fa-plus-square" aria-hidden="true"></i> <span class="hidden-xs">Órden de trabajo</span>',
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nuevo reporte</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-reports' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">entrega de materiales</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo reporte',
        'back-reports'   => 'Regresar a entrega de materiales'
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_report_title' => 'Eliminar orden de retiro',
        'delete_report_message' => '¿Está seguro de borrar la orden de retiro # :id?',
    ],

    'labelCollector' => 'Escalera: ',
    'labelOperator' => 'Operador: ',
    'labelStatus' => 'Estado: ',
    'labelDescription' => 'Descripción: ',
    'labelCreated' => 'Creación: ',
    'labelUpdated' => 'Actualización: ',
    'labelReaded' => 'Lectura: ',

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para el reporte.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción de la entrega de material',
];
