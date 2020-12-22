<?php

return [

    // Titles
    'showing-all-reports'     => 'Mostrando todos los reportes',
    'create-new-report'       => 'Crear nueva orden de retiro',
    'editing-report'          => 'Editando el reporte :id',
    'showing-mt-title'    => 'Creando la solicitud de material',

    // Flash Messages
    'createSuccess'   => '¡Reporte creado!',
    'createError'   => 'Error creando el reporte',
    'updateSuccess'   => '¡Reporte actualizado!',
    'updateError'   => 'Error actualizado el reporte',
    'deleteSuccess'   => '¡Reporte eliminado!',
    'deleteError'   => 'Error eliminando el reporte',

    'reports-table' => [
        'caption'   => '{1} Existe un único reporte.|[2,*] Cantidad total de reportes: :reportstotal.',
        'id'        => 'ID',
        'alert'     => 'Alerta',
        'order'     => 'Orden de trabajo',
        'creator'     => 'Creador',
        'novelty'     => 'Novedad',
        'subnovelty'     => 'Subnovedad',
        'status'     => 'Estado',
        'worktype'     => 'Tipo de trabajo',
        'readed'     => 'Lectura',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create_workorder'    => '<i class="fa fa-fw fa-plus-square" aria-hidden="true"></i> <span class="hidden-xs">Órden de trabajo</span>',
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nuevo reporte</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-reports' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">ordenes de retiro</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo reporte',
        'back-reports'   => 'Regresar a ordenes de retiro'
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_report_title' => 'Eliminar reporte',
        'delete_report_message' => '¿Está seguro de borrar el reporte :id?',
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
    'create_ph_description' => 'Escriba la descripción de la orden de retiro.',
];
