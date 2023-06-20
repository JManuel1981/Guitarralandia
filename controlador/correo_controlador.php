<?php


require_once( 'vista/correo_vista.php' );

if ( isset( $_POST[ 'enviar' ] ) ) {
    $to_email = 'jmmartin44@alu.ucam.edu';
    $subject = $_POST[ 'asunto' ];
    $body = $_POST[ 'message' ];
    $headers = 'From: '.$_POST[ 'name' ].' / mail: '.$_POST[ 'email' ];

    if ( mail( $to_email, $subject, $body, $headers ) ) {
        echo "<script>alert('Email enviado correctamente a $to_email.')</script>";
    } else {
        echo "<script>alert('Email no enviado')</script>";
    }
}

?>