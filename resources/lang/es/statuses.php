<?php

return [

    // Titles
    'showing-all-statuses'     => 'Mostrando todos los estados',
    'create-new-status'       => 'Crear nuevo estado',
    'editing-status'          => 'Editando el estado :id',

    // Flash Messages
    'createSuccess'   => '¡Estado creado!',
    'createError'   => 'Error creando estado',
    'updateSuccess'   => '¡Estado actualizado!',
    'updateError'   => 'Error actualizado estado',
    'deleteSuccess'   => '¡Estado eliminado!',
    'deleteError'   => 'Error eliminando estado',

    'statuses-table' => [
        'caption'   => '{1} Existe un único estado.|[2,*] Cantidad total de estados: :statusestotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nuevo estado</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-statuses' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">estados</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo estado',
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_status_title' => 'Eliminar estado',
        'delete_status_message' => '¿Está seguro de borrar el estado :id?',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para el estado.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción para el estado.',
];
