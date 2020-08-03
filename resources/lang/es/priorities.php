<?php

return [

    // Titles
    'showing-all-priorities'     => 'Mostrando todas las prioridades',
    'create-new-priority'       => 'Crear nueva prioridad',
    'editing-priority'          => 'Editando la prioridad :id',

    // Flash Messages
    'createSuccess'   => '¡Prioridad creada!',
    'createError'   => 'Error creando la prioridad',
    'updateSuccess'   => '¡Prioridad actualizada!',
    'updateError'   => 'Error actualizado la prioridad',
    'deleteSuccess'   => '¡Prioridad eliminada!',
    'deleteError'   => 'Error eliminando la prioridad',

    'priorities-table' => [
        'caption'   => '{1} Existe única prioridad.|[2,*] Cantidad total de prioridades: :prioritiestotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva prioridad</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-priorities' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Prioridades</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva prioridad',
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_priority_title' => 'Eliminar prioridad',
        'delete_priority_message' => '¿Está seguro de borrar la prioridad :id?',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para la prioridad.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción de la prioridad.',
];
