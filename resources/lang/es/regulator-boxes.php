<?php

return [
    'audit' => [
        'unavailable_audits' => 'No existen datos de auditoria para este elemento.',

        'created' => [
            'metadata' => ':user_name [:audit_ip_address] creo el registro el :audit_created_at',
            'modified' => [
                'id' => 'ID: <strong>:new</strong>',
                'user_id' => 'Usuario: <strong>:new</strong>',
                'intersection_id' => 'Intersección: <strong>:new</strong>',
                'latitude' => 'Latitud: <strong>:new</strong>',
                'longitude' => 'Longitud: <strong>:new</strong>',
                'google_address' => 'Dirección en Google: <strong>:new</strong>',
                'picture_in' => 'Foto interior: <strong>:new</strong>',
                'picture_out' => 'Foto exterior: <strong>:new</strong>',
                'code' => 'Código: <strong>:new</strong>',
                'erp_code' => 'Código en el ERP: <strong>:new</strong>',
                'brand' => 'Fabricante: <strong>:new</strong>',
                'state' => 'Estado: <strong>:new</strong>',
                'comment' => 'Observaciones: <strong>:new</strong>',
            ],
        ],

        'updated' => [
            'metadata' => ':user_name [:audit_ip_address] actualizó el registro el :audit_created_at',
            'modified' => [
                'user_id' => 'El usuario fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'intersection_id' => 'La intersección fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'latitude' => 'La latitud fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'longitude' => 'La longitud fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'google_address' => 'La dirección en Google fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'picture_in' => 'La foto interior fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'picture_out' => 'La foto exterior fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'code' => 'El código fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'erp_code' => 'El código en el ERP fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'brand' => 'La marca fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'state' => 'El estado fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'comment' => 'Las observaciones fueron modificadas de <strong>:old</strong> a <strong>:new</strong>',
            ],
        ],

        'button' => 'Auditar',

        'auditing-regulator-box' => 'Auditando el regulador: :id',
        'auditing-regulator-box-title' => 'Auditoria del regulador: :id',

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
    'showing-all-regulator-boxes'     => 'Mostrando todos los reguladores de tráfico',
    'regulator_boxes-menu-alt'        => 'Mostrar menú de gestión de reguladores de tráfico',
    'create-new-regulator-box'       => 'Crear nuevo regulador de tráfico',
    'editing-regulator-box'          => 'Editando el regulador: :code',
    'showing-regulator-box'  => 'Mostrando el regulador :code',
    'showing-regulator-box-title'    => 'Información del regulador: :code',

    // Flash Messages
    'createSuccess'   => '¡Regulador creado con éxito! ',
    'updateSuccess'   => '¡Regulador actualizado con éxito! ',
    'deleteSuccess'   => '¡Regulador eliminado con éxito! ',

    // Show traffic regulator Tab
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelLatitude'         => 'Latitud:',
    'labelLongitude'         => 'Longitud:',
    'labelGoogleAddress'         => 'Dirección en Google:',
    'labelBrand'         => 'Fabricante:',
    'labelComment'         => 'Comentario:',
    'labelUser'         => 'Usuario:',
    'labelState'         => 'Estado:',
    'labelIntersection'         => 'Intersección:',
    'labelStreet1'         => 'Calle 1:',
    'labelStreet2'         => 'Calle 2:',
    'labelPicuteIn'         => 'Foto interior:',
    'labelPicuteOut'         => 'Foto exterior:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'regulator-boxes-table' => [
        'caption'   => ':rbox_count/:rbox_total reguladores de tráfico',
        'id'        => 'ID',
        'intersection'     => 'Intersección',
        'state'     => 'Estado',
        'code'     => 'Código',
        'erp_code'     => 'Código en el ERP',
        'latitude'     => 'Latitud',
        'longitude'     => 'Longitud',
        'google_address'   => 'Direccion en Google',
        'brand'     => 'Fabricante',
        'intersection'     => 'Intersección',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo regulador',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-regulator-boxes' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">reguladores</span>',
        'back-to-regulator-box'  => '<span class="hidden-xs">Regresar a regulador</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo regulador de tráfico',
        'back-regulator-boxes'    => 'Regresar a reguladores de tráfico',
        'submit-search' => 'Enviar búsqueda de reguladores de tráfico',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'regulator-box-creation-success'  => '¡Regulador de tráfico creado con éxito!',
        'update-regulator-box-success'    => '¡Regulador de tráfico actualizado con éxito!',
        'update-regulator-box-error'    => 'Actualización de regulador fallida.',
        'show-error'    => 'Regulador no encontrado.',
        'delete-error'    => 'Se produjo un error eliminando el regulator de tráfico.',
        'delete-success'         => '¡Regulador de tráfico eliminado con éxito!'
    ],

    'show-regulator' => [
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
        'search-regulator-box-ph'   => 'Buscar regulador de tráfico',
    ],

    'modals' => [
        'delete_traffic_regulator_message' => '¿Estás seguro que quiere eliminar el regulador de tráfico: :code?',
    ],
];
