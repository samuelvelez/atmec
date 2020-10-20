<?php

return [

    // Titles
    'showing-all-intersections'     => 'Mostrando todas las intersecciones',
    'intersections-menu-alt'        => 'Mostrar menú de gestión de intersecciones',
    'create-new-intersection'       => 'Crear nueva intersección',
    'show-deleted-users'    => 'Mostrar usuario borrado',
    'editing-intersection'          => 'Editando la intersección: :id',
    'showing-si'  => 'Mostrando producto en bodega :id',
    'showing-si-title'    => 'Información del producto en bodega :id',

    // Flash Messages
    'createSuccess'   => '¡Intersección creada con éxito! ',
    'updateSuccess'   => '¡Intersección actualizada con éxito! ',
    'deleteSuccess'   => '¡Intersección eliminada con éxito! ',
    'deleteSelfError' => '¡No puedes eliminarte a ti mismo! ',

    // Show User Tab
    'viewProfile'            => 'Ver perfil',
    'editUser'               => 'Editar usuario',
    'deleteUser'             => 'Eliminar usuario',
    'usersBackBtn'           => 'Regresar a usuarios',
    'usersPanelTitle'        => 'Información de usuario',
    'labelLatitude'          => 'Latitud:',
    'labelLongitude'         => 'Longitud:',
    'labelMainStreet'         => 'Calle principal:',
    'labelCrossStreet'         => 'Calle cruzada:',
        'labelStreet1'         => 'Calle 1:',
    'labelStreet2'         => 'Calle 2:',
    'labelComment'         => 'Comentario:',
    'labelGoogleAddress'         => 'Dirección en Google:',
    'usersDeletedPanelTitle' => 'Información del usuario eliminado',
    'usersBackDelBtn'        => 'Regresar a usuarios eliminados',

    'successRestore'    => 'Usuario restaurado exitosamente.',
    'successDestroy'    => 'Registro de usuario destruido exitosamente.',
    'errorUserNotFound' => 'Usuario no encontrado.',

    'storage-inventory-table' => [
        'caption'   => 'Mostrando :inventoriescount/:inventoriestotal productos en bodega',
        'id'        => 'ID',
        'main_st'      => 'Calle principal',
        'cross_st'     => 'Calle cruzada',
        'latitude'     => 'Latitud',
        'longitude'     => 'Longitud',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nueva intersección',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-si' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">productos en bodega</span>',
        'back-to-si'  => '<span class="hidden-xs">Regresar a productos en bodega</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva intersección',
        'back-si'    => 'Regresar a productos en bodega',
        'submit-search' => 'Enviar búsqueda de intersecciones',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'intersection-creation-success'  => '¡Intersección creada con éxito!',
        'update-intersection-success'    => '¡Intersección actualizada con éxito!',
        'update-intersection-error'    => 'Actualización de intersección fallida.',
        'delete-success'         => '¡Intersección eliminada con éxito!'
    ],

    'show-intersection' => [
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
        'search-intersections-ph'   => 'Buscar intersecciones',
    ],

    'modals' => [
        'delete_user_message' => '¿Estás seguro que quieres borrar a :user?',
    ],
];
