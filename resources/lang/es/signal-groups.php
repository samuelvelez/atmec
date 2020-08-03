<?php

return [
    // Titles
    'showing-all-signal-groups'     => 'Mostrando todos los grupos de señales',
    'signal-groups-menu-alt'        => 'Mostrar menú de gestión de grupos de señales',
    'create-new-signal-group'       => 'Crear nuevo grupo',
    'editing-signal-group'          => 'Editando el grupo: :id',
    'showing-signal-group'  => 'Mostrando el grupo: :id',
    'showing-signal-group-title'    => 'Información del grupo: :id',

    // Flash Messages
    'createSuccess'   => '¡Grupo creado con éxito! ',
    'updateSuccess'   => '¡Grupo actualizado con éxito! ',
    'deleteSuccess'   => '¡Grupo eliminado con éxito! ',

    // Show traffic group Tab
    'labelCode'         => 'Código:',
    'labelName'         => 'Nombre:',
    'labelDescription'         => 'Descripión:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'signal-groups-table' => [
        'caption'   => ':groupstotal grupos de señales.',
        'id'        => 'ID',
        'code'        => 'Código',
        'name'        => 'Nombre',
        'subgroups'        => 'Subgrupos',
        'description'        => 'Descripción',
        'actions'        => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo grupo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-signal-groups' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">grupos</span>',
        'back-to-signal-group'  => '<span class="hidden-xs">Regresar al grupo</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo grupo',
        'back-signal-groups'    => 'Regresar a grupos',
    ],

    'messages' => [
        'signal-group-creation-success'  => '¡Grupo creado con éxito!',
        'update-signal-group-success'    => '¡Grupo actualizado con éxito!',
        'update-signal-group-error'    => 'Actualización de grupo fallida.',
        'show-signal-group-error'    => 'Grupo no encontrado.',
        'delete-success'         => '¡Grupo eliminado con éxito!'
    ],

    'show-signal-group' => [
        'id'                => 'ID',
        'code'            => 'Código:',
        'name'              => 'Nombre:',
        'description'       => 'Descripción',
        'created'           => 'Creado <span class="hidden-xs">el</span>:',
        'updated'           => 'Actualizado <span class="hidden-xs">el</span>:',
    ],

    'modals' => [
        'delete_signal_group_title' => 'Eliminar grupo de señales',
        'delete_signal_group_message' => '¿Está seguro que desea eliminar el grupo de señales: :id? Esta operación es peligrosa, con él eliminará todas sus señales verticales.',
    ],

    'edit_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Guardar cambios',
    'create_button_text' => '<i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear',
    'create_label_code' => 'Código*',
    'create_ph_code' => 'Escriba un código para el grupo. Recuerde debe ser único.',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba el nombre para el nuevo grupo de señales.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción del nuevo grupo de señales.',
];
