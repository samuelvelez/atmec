<?php

return [
    // Titles
    'showing-all-signal-subgroups' => 'Mostrando todos los subgrupos de señales',
    'signal-subgroups-menu-alt' => 'Mostrar menú de gestión de subgrupos de señales',
    'create-new-signal-subgroup' => 'Crear nuevo subgrupo',
    'editing-signal-subgroup' => 'Editando el subgrupo: :id',
    'showing-signal-subgroup' => 'Mostrando el subgrupo: :id',
    'showing-signal-subgroup-title' => 'Información del subgrupo: :id',

    // Flash Messages
    'createSuccess' => '¡Subgrupo creado con éxito! ',
    'updateSuccess' => '¡Subgrupo actualizado con éxito! ',
    'deleteSuccess' => '¡Subgrupo eliminado con éxito! ',

    // Show traffic subgroup Tab
    'labelCode' => 'Código:',
    'labelName' => 'Nombre:',
    'labelDescription' => 'Descripión:',
    'labelCreatedAt' => 'Creado el:',
    'labelUpdatedAt' => 'Actualizado el:',

    'signal-subgroups-table' => [
        'caption' => ':subgroupstotal subgrupos de señales.',
        'id' => 'ID',
        'code' => 'Código',
        'name' => 'Nombre',
        'shape' => 'Forma',
        'group' => 'Grupo',
        'shape' => 'Forma',
        'colors' => 'Colores',
        'description' => 'Descripción',
        'actions' => 'Acciones',
    ],

    'buttons' => [
        'create-new' => 'Nuevo subgrupo',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-signal-subgroups' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">subgrupos</span>',
        'back-to-signal-subgroup' => '<span class="hidden-xs">Regresar al subgrupo</span>',
    ],

    'tooltips' => [
        'delete' => 'Eliminar',
        'show' => 'Mostrar',
        'edit' => 'Editar',
        'create-new' => 'Crear nuevo subgrupo',
        'back-signal-subgroups' => 'Regresar a subgrupos',
    ],

    'messages' => [
        'signal-subgroup-creation-success' => '¡Subgrupo creado con éxito!',
        'update-signal-subgroup-success' => '¡Subgrupo actualizado con éxito!',
        'update-signal-subgroup-error' => 'Actualización de subgrupo fallida.',
        'show-signal-subgroup-error' => 'Subgrupo no encontrado.',
        'delete-success' => '¡Subgrupo eliminado con éxito!'
    ],

    'show-signal-subgroup' => [
        'id' => 'ID',
        'code' => 'Código:',
        'name' => 'Nombre:',
        'description' => 'Descripción',
        'group' => 'Grupo:',
        'shape' => 'Forma:',
        'colors' => 'Colores',
        'created' => 'Creado <span class="hidden-xs">el</span>:',
        'updated' => 'Actualizado <span class="hidden-xs">el</span>:',
    ],

    'modals' => [
        'delete_signal_subgroup_title' => 'Eliminar subgrupo de señales',
        'delete_signal_subgroup_message' => '¿Está seguro que desea eliminar el subgrupo de señales: :id? Esta operación es peligrosa, con él eliminará todas sus señales verticales.',
    ],

    'edit_button_text' => 'Guardar',
    'create_button_text' => 'Crear',
    'create_label_group' => 'Grupo*',
    'create_ph_group' => 'Seleccione el grupo',
    'create_label_shape' => 'Forma*',
    'create_ph_shape' => 'Seleccione la forma',
    'create_label_colors' => 'Colores*',
    'create_ph_colors' => 'Seleccione los colores',
    'create_label_code' => 'Código*',
    'create_ph_code' => 'Escriba un código para el subgrupo. Recuerde debe ser único.',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba el nombre para el nuevo subgrupo de señales.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción del nuevo subgrupo de señales.',
];
