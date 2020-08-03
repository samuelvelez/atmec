<?php

return [

    // Titles
    'showing-all-metrics'     => 'Mostrando todas las unidades de medida',
    'create-new-metric'       => 'Crear nueva unidad de medida',
    'editing-metric'          => 'Editando la unidad de medida :id',

    // Flash Messages
    'createSuccess'   => '¡Unidad de medida creada!',
    'createError'   => 'Error creando la unidad de medida',
    'updateSuccess'   => '¡Unidad de medida actualizada!',
    'updateError'   => 'Error actualizado la unidad de medida',
    'deleteSuccess'   => '¡Unidad de medida eliminada!',
    'deleteError'   => 'Error eliminando la unidad de medida',

    'metrics-table' => [
        'caption'   => '{1} Existe una única unidad de medida.|[2,*] Cantidad total de unidades de medida: :metricstotal.',
        'id'        => 'ID',
        'name'     => 'Nombre',
        'abbreviation'     => 'Abreviatura',
        'description'     => 'Descripción',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create'    => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i> <span class="hidden-xs">Nueva unidad de medida</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-metrics' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Unidades de medida</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva unidad de medida',
    ],

    'messages' => [
        'nameRequired'       => 'El nombre es requerido',
        'abbreviationRequired'       => 'La abreviatura es requerida',
    ],

    'modals' => [
        'delete_metric_title' => 'Eliminar unidad de medida',
        'delete_metric_message' => '¿Está seguro de eliminar la unidad de medida :id?',
    ],

    'edit_button_text' => 'Guardar',
    'create_button_text' => 'Crear',
    'create_label_name' => 'Nombre*',
    'create_ph_name' => 'Escriba un nombre para la unidad de medida.',
    'create_label_abbreviation' => 'Abreviatura*',
    'create_ph_abbreviation' => 'Escriba abreviatura para la unidad de medida.',
    'create_label_description' => 'Descripción',
    'create_ph_description' => 'Escriba la descripción.',
];
