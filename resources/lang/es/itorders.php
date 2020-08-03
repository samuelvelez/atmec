<?php

return [

    // Titles
    'showing-all-itorders'     => 'Mostrando todas las OETs',
    'create-new-itorder'       => 'Crear nueva OET',
    'showing-itorder-title'       => 'Mostrando la OET: :id',
    'editing-itorder'          => 'Editando la OET :id',

    // Flash Messages
    'createSuccess'   => '¡OET creada!',
    'createError'   => 'Error creando la OET',
    'updateSuccess'   => '¡OET actualizada!',
    'updateError'   => 'Error actualizado la OET',
    'deleteSuccess'   => '¡OET eliminada!',
    'deleteError'   => 'Error eliminando la OET',

    'labelCollector' => 'Escalera: ',
    'labelCreated' => 'Creación: ',
    'labelUpdated' => 'Actualización: ',

    'itorders-table' => [
        'caption'   => '{1} Existe una única OET.|[2,*] Cantidad total de OETs: :itorderstotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'materials'     => 'Materiales',
        'collector'     => 'Escalera',
        'created'     => 'Fecha de creación',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva OET</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Mostrar</span>',
        'back-to-itorders' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">OETs</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva OET',
        'back-itorders' => 'Regresar a OETs',
    ],

    'messages' => [
        'nameRequired'       => 'Username is required',
    ],

    'modals' => [
        'delete_itorder_title' => 'Eliminar OET',
        'delete_itorder_message' => '¿Está seguro de borrar la OET :id?',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre corto para la OET.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba una breve descripción.',
];
