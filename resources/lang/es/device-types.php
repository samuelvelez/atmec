<?php

return [
    // Titles
    'showing-all-devicetypes' => 'Mostrando todos los tipos de dispositivos',
    'signal-subgroups-menu-alt' => 'Mostrar menú de gestión de subgrupos de señales',
    'create-new-devicetype' => 'Crear nuevo tipo de dispositivo',
    'editing-signal-subgroup' => 'Editando el tipo de dispositivo: :id',
    'showing-signal-subgroup' => 'Mostrando el tipo de dispositivo: :id',
    'showing-signal-subgroup-title' => 'Información del tipo de dispositivo: :id',

    // Flash Messages
    'createSuccess' => '¡Tipo de dispositivo creado con éxito! ',
    'updateSuccess' => '¡Tipo de dispositivo actualizado con éxito! ',
    'deleteSuccess' => '¡Tipo de dispositivo eliminado con éxito! ',

    // Show traffic subgroup Tab
    'labelCode' => 'Código:',
    'labelName' => 'Nombre:',
    'labelDescription' => 'Descripión:',
    'labelCreatedAt' => 'Creado el:',
    'labelUpdatedAt' => 'Actualizado el:',

    'signal-subgroups-table' => [
        'caption' => ':subgroupstotal tipos de dispositivos.',
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
        'create-new' => 'Nuevo tipo de dispositivo',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-brands' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">tipos de dispositivos</span>',
        'back-to-brands1' => '<span class="hidden-xs">Regresar a tipos de dispositivos</span>',
    ],

    'tooltips' => [
        'delete' => 'Eliminar',
        'show' => 'Mostrar',
        'edit' => 'Editar',
        'create-new' => 'Crear nuevo tipo de dispositivo',
        'back-brands' => 'Regresar a tipos de dispositivos',
    ],

    'messages' => [
        'signal-subgroup-creation-success' => '¡Tipo de dispositivo creado con éxito!',
        'update-signal-subgroup-success' => '¡Tipo de dispositivo actualizado con éxito!',
        'update-signal-subgroup-error' => 'Actualización del tipo de dispositivo fallida.',
        'show-signal-subgroup-error' => 'Tipo de dispositivo no encontrado.',
        'delete-success' => '¡Tipo de dispositivo eliminado con éxito!'
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
        'delete_signal_subgroup_title' => 'Eliminar tipo de dispositivo',
        'delete_signal_subgroup_message' => '¿Está seguro que desea eliminar el tipo de dispositivo: :id? Esta operación es peligrosa.',
    ],

    'edit_button_text' => 'Guardar',
    'create_button_text' => 'Crear',
    'create_label_type' => 'Tipo al que pertenece',
    'create_ph_type' => 'Seleccione el tipo al que pertenece',
    'create_label_description' => 'Descripción*',
    'create_ph_description' => 'Escriba la descripción del dispositivo',
    'create_label_colors' => 'Colores*',
    'create_ph_colors' => 'Seleccione los colores',
    'create_label_code' => 'Código*',
    'create_ph_code' => 'Escriba un código para el subgrupo. Recuerde debe ser único.',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba el nombre para el nuevo subgrupo de señales.',
    'create_label_description' => 'Descripción',
];
