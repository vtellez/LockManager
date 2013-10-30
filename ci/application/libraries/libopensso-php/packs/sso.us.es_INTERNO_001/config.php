<?php
define('OPENSSO_INTERNAL_URL', 'http://192.168.1.126/OPENSSO/index.php/');
define('OPENSSO_BASE_URL', 'https://sso.us.es/OPENSSO/index.php/');
define('OPENSSO_COOKIE_NAME', 'iPlanetDirectoryPro');
define('OPENSSO_LOGIN_URL',      OPENSSO_BASE_URL . 'UI/Login');
define('OPENSSO_LOGOUT_URL',     OPENSSO_BASE_URL . 'UI/Logout');
define('OPENSSO_IS_TOKEN_VALID', OPENSSO_INTERNAL_URL .  'identity/isTokenValid');
define('OPENSSO_ATTRIBUTES',     OPENSSO_INTERNAL_URL . 'identity/attributes');
define('OPENSSO_COOKIE_NAME_FETCH',     OPENSSO_INTERNAL_URL .  'identity/getCookieNameForToken');
define('OPENSSO_DOMAIN', ".us.es");


// Certificados
define('VALIDATE_CERT', false);
define('CRT_SERIALNUMBER', '1021042076');

