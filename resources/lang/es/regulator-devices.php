<?php

return [
    'audit' => [
        'unavailable_audits' => 'No existen datos de auditoria para este elemento.',

        'created' => [
            'metadata' => ':user_name [:audit_ip_address] creo el registro el :audit_created_at',
            'modified' => [
                'id' => 'ID: <strong>:new</strong>',
                'user_id' => 'Usuario: <strong>:new</strong>',
                'regulatorbox_id' => 'Regulador: <strong>:new</strong>',
                'type' => 'Tipo de dispositivo: <strong>:new</strong>',
                'code' => 'Código: <strong>:new</strong>',
                'erp_code' => 'Código en el ERP: <strong>:new</strong>',
                'brand' => 'Fabricante: <strong>:new</strong>',
                'model' => 'Modelo: <strong>:new</strong>',
                'state' => 'Estado: <strong>:new</strong>',
                'comment' => 'Observaciones: <strong>:new</strong>',
            ],
        ],

        'updated' => [
            'metadata' => ':user_name [:audit_ip_address] actualizó el registro el :audit_created_at',
            'modified' => [
                'user_id' => 'El usuario fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'regulatorbox_id' => 'El regulador fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'type' => 'El tipo de dispositivo fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'code' => 'El código fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'erp_code' => 'El código en el ERP fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'brand' => 'La marca fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'model' => 'El modelo fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'state' => 'El estado fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'comment' => 'Las observaciones fueron modificadas de <strong>:old</strong> a <strong>:new</strong>',
                'intersection_id' => 'La intersección fue modificada de <strong>:old</strong> a <strong>:new</strong>',
            ],
        ],

        'button' => 'Auditar',

        'auditing-regulator-device' => 'Auditando el dispositivo de regulador: :id',
        'auditing-regulator-device-title' => 'Auditoria del dispositivo de regulador: :id',

        'audits-table' => [
            'id' => 'ID',
            'ip' => 'IP',
            'change' => 'Cambio',
            'operation' => 'Operación',
            'user' => 'Usuario',
            'event' => 'Evento',
            'report' => 'Reporte',
            'date' => 'Fecha',
        ],
    ],


    // Titles
    'showing-all-regulator-devices'     => 'Mostrando todos los dispositivos de cajas reguladoras',
    'regulator-devices-menu-alt'        => 'Mostrar menú de gestión de dispositivos de cajas reguladoras',
    'create-new-regulator-device'       => 'Crear nuevo dispositivos de caja reguladora',
    'editing-regulator-device'          => 'Editando el dispositivos de caja reguladora: :code',
    'showing-regulator-device'  => 'Mostrando el dispositivos de caja reguladora :code',
    'showing-regulator-device-title'    => 'Información del dispositivo de caja reguladora: :code',

    // Flash Messages
    'createSuccess'   => '¡Dispositivos de caja reguladora creado con éxito! ',
    'updateSuccess'   => '¡Dispositivos de caja reguladora actualizado con éxito! ',
    'deleteSuccess'   => '¡Dispositivos de caja reguladora eliminado con éxito! ',

    // Show traffic pole Tab
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelBrand'         => 'Fabricante:',
    'labelModel'         => 'Modelo:',
    'labelRegulator'         => 'Regulador:',
    'labelState'         => 'Estado:',
    'labelUser'         => 'Usuario:',
    'labelComment'         => 'Comentario:',
    'labelType'         => 'Tipo:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'regulator-devices-table' => [
        'caption'   => ':devicescount/:devicestotal dispositivos de cajas reguladoras',
        'regulator'        => 'Reguladora',
        'id'      => 'ID',
        'code'      => 'Código',
        'state'     => 'Estado',
        'type'     => 'Tipo',
        'brand'     => 'Fabricante',
        'model'     => 'Modelo',
        'erp-code'     => 'Código de ERP',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo dispositivo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-regulator-devices' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">dispositivos</span>',
        'back-to-regulator-device'  => '<span class="hidden-xs">Regresar a dispositivos de cajas reguladoras</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo dispositivo de caja reguladora',
        'back-regulator-devices'    => 'Regresar a dispositivos de cajas reguladoras',
        'submit-search' => 'Enviar búsqueda de dispositivos de cajas reguladoras',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'regulator-device-creation-success'  => '¡Dispositivo de caja reguladora creado con éxito!',
        'update-regulator-device-success'    => '¡Dispositivo de caja reguladora actualizado con éxito!',
        'update-regulator-device-error'    => 'Actualización de dispositivo de caja reguladora fallida.',
        'delete-success'         => '¡Dispositivo de caja reguladora eliminado con éxito!'
    ],

    'show-regulator-device' => [
        'id'                => 'ID',
        'name'              => 'Nombre de usuario',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'Rol de usuario',
        'created'           => 'Creada <span class="hidden-xs">el</span>',
        'updated'           => 'Actualizada <span class="hidden-xs">el</span>',
    ],

    'search'  => [
        'title'             => 'Mostrando resultados de búsqueda',
        'found-footer'      => ' Registro(s) encontrado(s)',
        'no-results'        => 'No hay resultados',
        'search-regulator-devices-ph'   => 'Buscar dispositivo de caja reguladora',
    ],

    'modals' => [
        'delete_regulator_devices_message' => '¿Estás seguro que quiere eliminar el dispositivo de caja reguladora: :code?',
    ],
];
