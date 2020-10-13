<?php

return [
    // Titles
    'showing-all-ts' => 'Mostrando todos los tipos de semáforos',
    'showing-all-tlt' => 'Mostrando todos los tipos de semáforos',
    'signal-subgroups-menu-alt' => 'Mostrar menú de gestión de subgrupos de señales',
    'create-new-tlt' => 'Crear nuevo tipo de semáforo',
    'editing-signal-subgroup' => 'Editando el tipo de semáforo: :id',
    'showing-signal-subgroup' => 'Mostrando el tipo de semáforo: :id',
    'showing-signal-subgroup-title' => 'Información del semáforo: :id',

    // Flash Messages
    'createSuccess' => '¡Semáforo creado con éxito! ',
    'updateSuccess' => '¡Semáforo actualizado con éxito! ',
    'deleteSuccess' => '¡Semáforo eliminado con éxito! ',

    // Show traffic subgroup Tab
    'labelCode' => 'Código:',
    'labelName' => 'Nombre:',
    'labelDescription' => 'Descripión:',
    'labelCreatedAt' => 'Creado el:',
    'labelUpdatedAt' => 'Actualizado el:',

    'signal-subgroups-table' => [
        'caption' => ':subgroupstotal tipos de semáforos.',
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
        'create-new' => 'Nuevo tipo de semáforo',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-tlt' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">tipos de semáforo</span>',
        'back-to-signal-subgroup' => '<span class="hidden-xs">Regresar a los tipos de semáforos</span>',
    ],

    'tooltips' => [
        'delete' => 'Eliminar',
        'show' => 'Mostrar',
        'edit' => 'Editar',
        'create-new' => 'Crear nuevo tipo de semáforo',
        'back-brands' => 'Regresar a tipos de semáforo',
    ],

    'messages' => [
        'signal-subgroup-creation-success' => '¡Tipo de semáforo creado con éxito!',
        'update-signal-subgroup-success' => '¡Tipo de semáforo actualizado con éxito!',
        'update-signal-subgroup-error' => 'Actualización del tipo de semáforo fallida.',
        'show-signal-subgroup-error' => 'Tipo de semáforo no encontrado.',
        'delete-success' => '¡Tipo de semáforo eliminado con éxito!'
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
        'delete_signal_subgroup_title' => 'Eliminar tipo de semáforo',
        'delete_signal_subgroup_message' => '¿Está seguro que desea eliminar el tipo de semáforo: :id? Esta operación es peligrosa.',
    ],

    'edit_button_text' => 'Guardar',
    'create_button_text' => 'Crear',
    'create_label_brandtype' => 'Tipo de fabicante',
    'create_ph_brandtype' => 'Seleccione el tipo de fabricante',
    'create_label_description' => 'Descripción*',
    'create_ph_description' => 'Escriba la descripción del tipo de semáforo',
    'create_label_colors' => 'Colores*',
    'create_ph_colors' => 'Seleccione los colores',
    'create_label_code' => 'Código*',
    'create_ph_code' => 'Escriba un código para el subgrupo. Recuerde debe ser único.',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba el nombre para el nuevo subgrupo de señales.',
    'create_label_description' => 'Descripción',
];
