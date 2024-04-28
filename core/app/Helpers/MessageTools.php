<?php

namespace App\Helpers;

class MessageTools
{

    private static $TITLE = array(
        'success'   => 'Información',
        'error'     => '¡Error!'
    );

    private static $MESSAGE = array(
        'success'   => 'Operación realizada correctamente',
        'error'     => 'Ups!...Se ha producido un error'
    );

    private static $TYPE = array(
        'success'   => 'success',
        'error'     => 'error'
    );

    public static function generate($status, array $title = null, array $message = null) {
        $title = is_null($title) ? MessageTools::$TITLE : $title;
        $message = is_null($message) ? MessageTools::$MESSAGE : $message;

        return (Object) array(
            'status'    => $status,
            'title'     => $status ? $title['success'] : $title['error'],
            'message'   => $message ? $message['success'] : $message['error'],
            'type'      => $status ? MessageTools::$TYPE['success'] : MessageTools::$TYPE['error'],
        );
    }
}
