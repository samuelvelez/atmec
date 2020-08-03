<?php

return [
    'audit' => [
        'unavailable_audits' => 'No existen datos de auditoria para este elemento.',

        'created' => [
            'metadata' => ':user_name [:audit_ip_address] creo el registro el :audit_created_at',
            'modified' => [
                'id' => 'ID: <strong>:new</strong>',
                'code' => 'Código: <strong>:new</strong>',
                'erp_code' => 'Código en el ERP: <strong>:new</strong>',
                'latitude' => 'Latitud: <strong>:new</strong>',
                'longitude' => 'Longitud: <strong>:new</strong>',
                'google_address' => 'Dirección en Google: <strong>:new</strong>',
                'signal_folder' => 'Carpeta: <strong>:new</strong>',
                'picture' => 'Foto: <strong>:new</strong>',
                'normative' => 'Normativa: <strong>:new</strong>',
                'comment' => 'Observaciones: <strong>:new</strong>',
                'orientation' => 'Orientación: <strong>:new</strong>',
                'state' => 'Estado: <strong>:new</strong>',
                'fastener' => 'Fijación: <strong>:new</strong>',
                'material' => 'Material: <strong>:new</strong>',

                'user_id' => 'ID de usuario: <strong>:new</strong>',
                'signal_id' => 'ID del tipo de señal: <strong>:new</strong>',
                'variation_id' => 'ID de la variación: <strong>:new</strong>',
            ],
        ],

        'updated' => [
            'metadata' => ':user_name [:audit_ip_address] actualizó el registro el :audit_created_at',
            'modified' => [
                'code' => 'El código fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'erp_code' => 'El código en el ERP fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'latitude' => 'La latitud fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'longitude' => 'La longitud fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'google_address' => 'La dirección en Google fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'signal_folder' => 'La carpeta de la foto fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'picture' => 'La foto fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'normative' => 'La normativa fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'comment' => 'Las observaciones fueron modificadas de <strong>:old</strong> a <strong>:new</strong>',
                'orientation' => 'La orientación fue modificada de <strong>:old</strong> a <strong>:new</strong>',
                'state' => 'El estado fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'fastener' => 'El fijador fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'material' => 'El material fue modificado de <strong>:old</strong> a <strong>:new</strong>',

                'user_id' => 'El usuario fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'signal_id' => 'El tipo de señal fue modificado de <strong>:old</strong> a <strong>:new</strong>',
                'variation_id' => 'La variación de la señal fue modificada de <strong>:old</strong> a <strong>:new</strong>',
            ],
        ],

        'button' => 'Auditar',

        'auditing-vertical-signal' => 'Auditando la señal vertical: :id',
        'auditing-vertical-signal-title' => 'Auditoria de la señal vertical: :id',

        'audits-table' => [
            'event' => 'Evento',
            'report' => 'Reporte',
        ],
    ],

    // Titles
    'showing-all-vsignals' => 'Mostrando todas las señales verticales',
    'vsignals-menu-alt' => 'Mostrar menú de gestión de señales verticales',
    'create-new-vsignal' => 'Crear nueva señal vertical',
    'show-deleted-vsignals' => 'Mostrar señales verticales eliminadas',
    'editing-vsignal' => 'Editando la señal vertical :code',
    'showing-vsignal' => 'Mostrando la señal vertical :name',
    'showing-vsignal-title' => 'Información de la señal vertical: :name',

    // Flash Messages
    'createSuccess' => '¡Señal vertical creada! ',
    'updateSuccess' => '¡Señal vertical actualizada! ',
    'deleteSuccess' => '¡Señal vertical eliminada! ',
    'deleteSelfError' => '¡Ud no puede auto eliminarse! ',

    // Show Vertical Signal Tab
    'viewProfile' => 'View Profile',
    'editUser' => 'Edit Vertical Signal',
    'deleteUser' => 'Delete Vertical Signal',
    'vsignalsBackBtn' => 'Regresar a señales verticales',
    'vsignalsPanelTitle' => 'User Information',
    'labelErpCode' => 'Código en el ERP:',
    'labelName' => 'Nombre de la señal:',
    'labelGroup' => 'Grupo:',
    'labelSubgroup' => 'Subgrupo:',
    'labelDimension' => 'Dimensión:',
    'labelVariation' => 'Variación:',
    'labelLatitude' => 'Latitud:',
    'labelLongitude' => 'Longitud:',
    'labelComment' => 'Comentario:',
    'labelGoogleAddress' => 'Dirección en Google:',
    'labelOrientation' => 'Orientación:',
    'labelNeighborhood' => 'Vecindario:',
    'labelParish' => 'Parroquía:',
    'labelState' => 'Estado:',
    'labelStreet1' => 'Calle 1:',
    'labelStreet2' => 'Calle 2:',
    'labelNormative' => 'Normativa:',
    'labelFastener' => 'Fijadores:',
    'labelMaterial' => 'Materiales:',
    'labelCollector' => 'Usuario:',
    'labelCreatedAt' => 'Creada el:',
    'labelUpdatedAt' => 'Actualizada el:',
    'labelIpEmail' => 'Email Signup IP:',
    'labelIpEmail' => 'Email Signup IP:',
    'labelIpConfirm' => 'Confirmation IP:',
    'labelIpSocial' => 'Socialite Signup IP:',
    'labelIpAdmin' => 'Admin Signup IP:',
    'labelIpUpdate' => 'Last Update IP:',
    'labelDeletedAt' => 'Deleted on',
    'labelIpDeleted' => 'Deleted IP:',
    'vsignalsDeletedPanelTitle' => 'Deleted Vertical Signal Information',
    'vsignalsBackDelBtn' => 'Regresar a señales verticales borradas',

    'successRestore' => 'Vertical Signal successfully restored.',
    'successDestroy' => 'Vertical Signal record successfully destroyed.',
    'errorUserNotFound' => 'Vertical Signal not found.',

    'labelUserLevel' => 'Level',
    'labelUserLevels' => 'Levels',

    'vsignals-table' => [
        'caption' => ':vsignalscount/:vsignalstotal señales verticales.',
        'id' => 'ID',
        'code' => 'Código',
        'creator' => 'Creador',
        'name' => 'Nombre',
        'latitude' => 'Latitud',
        'longitude' => 'Longitud',
        'picture' => 'Imagen',
        'comment' => 'Comentario',
        'orientation' => 'Orientacion',
        'google_address' => 'Direccion en Google',
        'street1' => 'Calle 1',
        'street2' => 'Calle 2',
        'neighborhood' => 'Vecindario',
        'parish' => 'Parroquia',
        'state' => 'Estado',
        'normative' => 'Normativa',
        'fastener' => 'Fijador',
        'material' => 'Material',
        'actions' => 'Acciones',
        'created' => 'Creada',
        'updated' => 'Actualizada',
    ],

    'buttons' => [
        'xlsx'          => 'Exportar a Excel',
        'create-new' => 'Nueva señal vertical',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> ',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ',
        'back-to-vsignals' => '<span class="hidden-sm hidden-xs">Regresar </span><span class="hidden-xs">a señales verticales</span>',
        'back-to-vsignal' => '<span class="hidden-xs">Regresar a la señal vertical</span>',
        'delete-vsignal' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ',
        'edit-vsignal' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ',
    ],

    'tooltips' => [
        'delete' => 'Eliminar',
        'show' => 'Mostrar',
        'edit' => 'Editar',
        'create-new' => 'Crear nueva señal vertical',
        'back-vsignals' => 'Regresar a señales verticales',
        'back-vsignal' => 'Regresar a señal vertical',
        'email-vsignal' => 'Email :vsignal',
        'submit-search' => 'Enviar búsqueda de señal vertical',
        'clear-search' => 'Limpiar los resultados de búsqueda',
    ],

    'messages' => [
        'vsignalNameTaken' => 'Username is taken',
        'vsignalNameRequired' => 'Username is required',
        'fNameRequired' => 'First Name is required',
        'lNameRequired' => 'Last Name is required',
        'emailRequired' => 'Email is required',
        'emailInvalid' => 'Email is invalid',
        'passwordRequired' => 'Password is required',
        'PasswordMin' => 'Password needs to have at least 6 characters',
        'PasswordMax' => 'Password maximum length is 20 characters',
        'captchaRequire' => 'Captcha is required',
        'CaptchaWrong' => 'Wrong captcha, please try again.',
        'roleRequired' => 'Vertical Signal role is required.',
        'vsignal-creation-success' => 'Successfully created vertical signal!',
        'update-vsignal-success' => 'Successfully updated vertical signal!',
        'delete-success' => '¡Señal vertical borrada con éxito!',
        'delete-error' => '¡Error eliminando la señal vertical!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-vsignal' => [
        'id' => 'User ID',
        'name' => 'Username',
        'email' => '<span class="hidden-xs">Vertical Signal </span>Email',
        'role' => 'Vertical Signal Role',
        'created' => 'Created <span class="hidden-xs">at</span>',
        'updated' => 'Updated <span class="hidden-xs">at</span>',
        'labelRole' => 'Vertical Signal Role',
        'labelAccessLevel' => '<span class="hidden-xs">Vertical Signal</span> Access Level|<span class="hidden-xs">Vertical Signal</span> Access Levels',
    ],

    'search' => [
        'title' => 'Mostrando los resultados de la búsqueda',
        'found-footer' => ' Señales(s) encontradas',
        'no-results' => 'Sin resultados',
        'search-vsignals-ph' => 'Buscar señales verticales',
    ],

    'modals' => [
        'delete_vsignal_message' => '¿Está seguro de borrar la señal vertical :vsignal?',
    ],
];
