<?php

return [

    // Titles
    'showing-all-motives'     => 'Mostrando todos los motivos',
    'create-new-motive'       => 'Crear nueva motivo',
    'editing-motive'          => 'Editando el motivo :id',

    // Flash Messages
    'createSuccess'   => '¡Motivo creado!',
    'createError'   => 'Error creando motivo',
    'updateSuccess'   => '¡Motivo actualizado!',
    'updateError'   => 'Error actualizado motivo',
    'deleteSuccess'   => '¡Motivo eliminado!',
    'deleteError'   => 'Error eliminando motivo',

    'motives-table' => [
        'caption'   => '{1} Existe un único motivo.|[2,*] Cantidad total de motivos: :motivestotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nuevo motivo</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-motives' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Motivos</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo motivo',
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_motive_title' => 'Eliminar motivo',
        'delete_motive_message' => '¿Está seguro de borrar el motivo :id?',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para el motivo.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción.',
];
