<?php

return [

    // Titles
    'showing-all-alerts'     => 'Mostrando todas las alertas',
    'create-new-alert'       => 'Crear nueva alerta',
    'editing-alert'          => 'Editando la alerta :id',
    'showing-alert-title'    => 'Mostrando la alerta :id',

    // Flash Messages
    'createSuccess'   => '¡Alerta creada!',
    'createError'   => 'Error creando la alerta',
    'updateSuccess'   => '¡Alerta actualizada!',
    'updateError'   => 'Error actualizado la alerta',
    'deleteSuccess'   => '¡Alerta eliminada!',
    'deleteError'   => 'Error eliminando la alerta',

    'alerts-table' => [
        'caption'   => '{1} Existe una única Orden de trabajo.|[2,*] Cantidad total de Ordenes: :alertstotal.',
        'id'        => 'ID',
        'collector'     => 'Escalera',
        'creator'     => 'Creador',
        'status'     => 'Estado',
        'address'     => 'Dirección',
        'readed'     => 'Lectura',
        'description'     => 'Comentario',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create_report'    => '<i class="fa fa-fw fa-binoculars" aria-hidden="true"></i> <span class="hidden-xs">Crear reporte</span>',
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva alerta</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-alerts' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">alertas</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva alerta',
        'back-alerts'   => 'Regresar a alertas'
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_alert_title' => 'Eliminar alerta',
        'delete_alert_message' => '¿Está seguro de borrar la alerta :id?',
    ],

    'labelCollector' => 'Escalera: ',
    'labelOperator' => 'Operador: ',
    'labelStatus' => 'Estado: ',
    'labelDescription' => 'Comentario: ',
    'labelCreated' => 'Creación: ',
    'labelUpdated' => 'Actualización: ',
    'labelReaded' => 'Lectura: ',

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_intersection' => 'Intersección',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para la alerta.',
    'create_label_description' => 'Comentario',
    'create_ph_description' => 'Escriba el comentario para la alerta.',
];