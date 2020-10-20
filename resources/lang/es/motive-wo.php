<?php

return [
    // Titles
    'showing-all-motives' => 'Mostrando todos los motivos',
    'signal-subgroups-menu-alt' => 'Mostrar menú de gestión de subgrupos de señales',
    'create-new-motivewo' => 'Crear nuevo motivo',
    'editing-signal-subgroup' => 'Editando el motivo: :id',
    'showing-signal-subgroup' => 'Mostrando el motivo: :id',
    'showing-signal-subgroup-title' => 'Información del motivo: :id',

    // Flash Messages
    'createSuccess' => '¡Motivo creado con éxito! ',
    'updateSuccess' => '¡Motivo actualizado con éxito! ',
    'deleteSuccess' => '¡Motivo eliminado con éxito! ',

    // Show traffic subgroup Tab
    'labelCode' => 'Código:',
    'labelName' => 'Nombre:',
    'labelDescription' => 'Descripión:',
    'labelCreatedAt' => 'Creado el:',
    'labelUpdatedAt' => 'Actualizado el:',

    'signal-subgroups-table' => [
        'caption' => ':subgroupstotal motivos de ordenes de trabajo.',
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
        'create-new' => 'Nuevo motivo',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-brands' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">motivos</span>',
        'back-to-motivewo' => '<span class="hidden-xs">Regresar a motivos</span>',
    ],

    'tooltips' => [
        'delete' => 'Eliminar',
        'show' => 'Mostrar',
        'edit' => 'Editar',
        'create-new' => 'Crear nuevo subgrupo',
        'back-motivewo' => 'Regresar a motivos',
    ],

    'messages' => [
        'signal-subgroup-creation-success' => '¡Motivo creado con éxito!',
        'update-signal-subgroup-success' => '¡Motivo actualizado con éxito!',
        'update-signal-subgroup-error' => 'Actualización de motivo fallida.',
        'show-signal-subgroup-error' => 'Motivo no encontrado.',
        'delete-success' => '¡Motivo eliminado con éxito!'
    ],

    'show-signal-subgroup' => [
        'id' => 'ID',
        'code' => 'Código:',
        'name' => 'Nombre:',
        'description' => 'Descripción',
        'group' => 'Grupo:',
        'tipo' => 'Tipo:',
        'colors' => 'Colores',
        'created' => 'Creado <span class="hidden-xs">el</span>:',
        'updated' => 'Actualizado <span class="hidden-xs">el</span>:',
    ],

    'modals' => [
        'delete_signal_subgroup_title' => 'Eliminar motivo',
        'delete_signal_subgroup_message' => '¿Está seguro que desea eliminar el motivo: :id? Esta operación es peligrosa.',
    ],

    'edit_button_text' => 'Guardar',
    'create_button_text' => 'Crear',
    'create_label_brandtype' => 'Tipo de fabicante',
    'create_ph_brandtype' => 'Seleccione el tipo de fabricante',
    'create_label_description' => 'Descripción*',
    'create_ph_description' => 'Escriba la descripción del motivo',
    'create_label_colors' => 'Colores*',
    'create_ph_colors' => 'Seleccione los colores',
    'create_label_code' => 'Código*',
    'create_ph_code' => 'Escriba un código para el subgrupo. Recuerde debe ser único.',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba el nombre para el nuevo subgrupo de señales.',
    'create_label_description' => 'Descripción',
];
