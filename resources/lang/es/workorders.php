<?php

return [

    // Titles
    'showing-all-workorders'     => 'Mostrando todas las órdenes de trabajo',
    'create-new-workorder'       => 'Crear nueva órden de trabajo',
    'editing-workorder'          => 'Editando la órden de trabajo :id',
    'closing-workorder'          => 'Cerrando la órden de trabajo :id',
    'showing-workorder-title'    => 'Mostrando la órden de trabajo :id',

    // Flash Messages
    'closeSuccess'   => '¡Órden de trabajo cerrada!',
    'closeError'   => '¡Error cerrando la órden de trabajo!',
    'completeSuccess'   => '¡Órden de trabajo finalizada!',
    'completeError'   => '¡Error finalizando la órden de trabajo!',
    'createSuccess'   => '¡Órden de trabajo creada!',
    'createError'   => 'Error creando la órden de trabajo',
    'updateSuccess'   => '¡Órden de trabajo actualizada!',
    'updateError'   => 'Error actualizado la órden de trabajo',
    'deleteSuccess'   => '¡Órden de trabajo eliminada!',
    'deleteError'   => 'Error eliminando la órden de trabajo',

    'workorders-table' => [
        'caption'   => '{1} Existe una única órden de trabajo.|[2,*] Cantidad total de órdenes de trabajo: :workorderstotal.',
        'id'        => 'ID',
        'report'     => 'Reporte',
        'collector'     => 'Escalera',
        'status'     => 'Estado',
        'priority'     => 'Prioridad',
        'started'     => 'Iniciada',
        'completed'     => 'Cerrada',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'close_order'    => '<i class="fa fa-fw fa-close" aria-hidden="true"></i> <span class="hidden-xs">Cerrar órden</span>',
        'complete_order'    => '<i class="fa fa-fw fa-adjust" aria-hidden="true"></i> <span class="hidden-xs">Finalizar órden</span>',
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva órden de trabajo</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-workorders' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">órdenes de trabajo</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva órden de trabajo',
        'back-workorders'   => 'Regresar a órdenes de trabajo'
    ],

    'messages' => [
        'collectorRequired'       => 'Debe seleccionar una escalera',
        'priorityRequired'       => 'Debe seleccionar una prioridad',
        'descriptionRequired'       => 'Debe escribir una descripción',
    ],

    'modals' => [
        'delete_workorder_title' => 'Eliminar órden de trabajo',
        'delete_workorder_message' => '¿Está seguro de borrar la órden de trabajo :id?',
    ],

    'labelOrderCollector' => 'Escalera de la orden: ',
    'labelAlertCollector' => 'Escalera de la alerta: ',
    'labelAlertDescription' => 'Descripción de la alerta: ',
    'labelReportDescription' => 'Descripción del reporte: ',
    'labelOrderDescription' => 'Descripción de la órden: ',
    'labelCompletedDescription' => 'Descripción de cierre: ',
    'labelStatus' => 'Estado de la órden: ',
    'labelPriority' => 'Prioridad: ',
    'labelDescription' => 'Descripción: ',
    'labelCreated' => 'Creación: ',
    'labelUpdated' => 'Actualización: ',
    'labelStarted' => 'Iniciada: ',
    'labelCompleted' => 'Completada: ',

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para la órden de trabajo.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción para el órden de trabajo.',
];
