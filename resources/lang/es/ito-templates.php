<?php

return [

    // Titles
    'showing-all-templates'     => 'Mostrando todas las plantillas',
    'create-new-template'       => 'Crear nueva plantilla',
    'showing-template-title'       => 'Mostrando la plantilla: :id',
    'editing-template'          => 'Editando la plantilla :id',

    // Flash Messages
    'createSuccess'   => '¡Plantilla creada!',
    'createError'   => 'Error creando la plantilla',
    'updateSuccess'   => '¡Plantilla actualizada!',
    'updateError'   => 'Error actualizado la plantilla',
    'deleteSuccess'   => '¡Plantilla eliminada!',
    'deleteError'   => 'Error eliminando la plantilla',

    'labelName' => 'Nombre: ',
    'labelDescription' => 'Descripción: ',
    'labelCreated' => 'Creación: ',
    'labelUpdated' => 'Actualización: ',

    'templates-table' => [
        'caption'   => '{1} Existe una única plantilla.|[2,*] Cantidad total de plantillas: :templatestotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'materials'     => 'Materiales',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva plantilla</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'back-to-templates' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">plantillas</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva plantilla',
        'back-templates' => 'Regresar a plantillas',
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_template_title' => 'Eliminar plantilla',
        'delete_template_message' => '¿Está seguro de borrar la plantilla :id?',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para la plantilla.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba una breve descripción.',
];
