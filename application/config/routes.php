<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'Auth';
    $route['nuevo-certificado'] = 'Cnuevo_cer';
    $route['consulta-de-certificado-digital'] = 'Cconsultar_cer';
    $route['autorizar-certificado-digital'] = 'Cautorizar_cer';
    $route['administrar-certificado-digital'] = 'Cadministrar_cer';

    $route['asistencia-magistrados'] = 'control_asistencia/Casistencia_magistrados';
    $route['administradores-maestras'] = 'administradores/Cmaestra';
    $route['administradores-procesos'] = 'administradores/Cprocesos';
    $route['administradores-consultas'] = 'administradores/Cconsulta';
    $route['administradores-mantenimiento'] = 'administradores/Cmanto';


    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;
