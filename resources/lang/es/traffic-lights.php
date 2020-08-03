<?php

return [
    'audit' => [
        'unavailable_audits' => 'No existen datos de auditoria para este elemento.',

        'created' => [
            'metadata' => ':user_name [:audit_ip_address] creo el registro el :audit_created_at',
            'modified' => [
                'id' => 'ID: <strong>:new</strong>',
                'code' => 'Código: <strong>:new</strong>',
                'brand' => 'Fabricante: <strong>:new</strong>',
                'model' => 'Modelo: <strong>:new</strong>',
                'state' => 'Estado: <strong>:new</strong>',
                'orientation' => 'Orientación: <strong>:new</strong>',
                'fastener' => 'Fijación: <strong>:new</strong>',
                'comment' => 'Observaciones: <strong>:new</strong>',
                'erp_code' => 'Código en el ERP: <strong>:new</strong>',
                'picture' => 'Foto: <strong>:new</strong>',
                'light_folder' => 'Carpeta: <strong>:new</strong>',

                'user_id' => 'ID de usuario: <strong>:new</strong>',
                'type_id' => 'ID del tipo de semáforo: <strong>:new</strong>',
                'intersection_id' => 'ID de la intersección: <strong>:new</strong>',
                'tensor_id' => 'ID del tensor: <strong>:new</strong>',
                'pole_id' => 'ID del poste: <strong>:new</strong>',
                'regulator_id' => 'ID del regulador: <strong>:new</strong>',
            ],
        ],

        'updated' => [
            'metadata' => ':user_name [:audit_ip_address] actualizó el registro el :audit_created_at',
            'modified' => [
                'code' => 'El código fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'brand' => 'La marca fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'model' => 'El modelo fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'state' => 'El estado fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'orientation' => 'La orientación fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'fastener' => 'El fijador fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'comment' => 'Las observaciones fueron modificadas de <strong>:old</strong> a <strong>:new</strong>',
                'erp_code' => 'El código en el ERP fue modificado de <strong>:old</strong> a <strong>:new</strong>',

                'user_id' => 'El usuario fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'type_id' => 'El tipo de semáforo fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'intersection_id' => 'La intersección fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'tensor_id' => 'El tensor fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'pole_id' => 'El poste fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'regulator_id' => 'El regulador fue modificado de <strong>:old</strong> a <strong>:new</strong>',
            ],
        ],

        'button' => 'Auditar',

        'auditing-traffic-light' => 'Auditando el semáforo: :id',
        'auditing-traffic-light-title' => 'Auditoria del semáforo: :id',

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
    'showing-all-traffic-lights'     => 'Mostrando todos los semáforos',
    'traffic-lights-menu-alt'        => 'Mostrar menú de gestión de semáforos',
    'create-new-traffic-light'       => 'Crear nuevo semáforo',
    'editing-traffic-light'          => 'Editando el semáforo: :id',
    'showing-traffic-light'  => 'Mostrando el semáforo :id',
    'showing-traffic-light-title'    => 'Información del semáforo: :id',

    // Flash Messages
    'createSuccess'   => '¡Semáforo creado con éxito! ',
    'updateSuccess'   => '¡Semáforo actualizado con éxito! ',
    'deleteSuccess'   => '¡Semáforo eliminado con éxito! ',

    // Show traffic light Tab
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelBrand'         => 'Fabricante:',
    'labelModel'         => 'Modelo:',
    'labelState'         => 'Estado:',
    'labelOrientation'         => 'Orientación:',
    'labelRegulator'         => 'Regulador:',
    'labelRegulator'         => 'Regulador:',
    'labelIntersection'         => 'Intersección:',
    'labelTensor'         => 'Tensor:',
    'labelPole'         => 'Poste:',
    'labelType'         => 'Tipo de semáforo:',
    'labelComment'         => 'Comentario:',
    'labelUser'         => 'Usuario:',
    'labelPoles'         => 'Postes de tráfico:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'traffic-lights-table' => [
        'caption'   => ':lightscount/:lightstotal semáforos',
        'id'        => 'ID',
        'code'        => 'Código',
        'intersection'        => 'Intersección',
        'erp-code'        => 'Código en el ERP',
        'state'     => 'Estado',
        'orientation'     => 'Orientación',
        'brand'     => 'Fabricante',
        'model'     => 'Modelo',
        'fastener'     => 'Fijadores',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'xlsx'          => 'Exportar a Excel',
        'create-new'    => 'Nuevo semáforo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-traffic-lights' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">semáforos</span>',
        'back-to-traffic-light'  => '<span class="hidden-xs">Regresar al semáforo</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo semáforo',
        'back-traffic-lights'    => 'Regresar a semáforos',
        'submit-search' => 'Enviar búsqueda de semáforos',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'traffic-light-creation-success'  => '¡Semáforo creado con éxito!',
        'update-traffic-light-success'    => '¡Semáforo actualizado con éxito!',
        'update-traffic-light-error'    => 'Actualización de semáfoto fallida.',
        'show-error'    => 'Tensor no encontrado.',
        'delete-success'         => '¡Semáforo eliminado con éxito!'
    ],

    'show-light' => [
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
        'search-traffic-lights-ph'   => 'Buscar semáforos',
    ],

    'modals' => [
        'delete_traffic_light_message' => '¿Estás seguro que quiere eliminar el semáforo: :id?',
    ],
];
