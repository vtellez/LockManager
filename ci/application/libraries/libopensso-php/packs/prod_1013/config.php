<?php
define('OPENSSO_BASE_URL', 'https://opensso.us.es/opensso/');
define('OPENSSO_COOKIE_NAME', 'iPlanetDirectoryPro');
define('OPENSSO_LOGIN_URL',      OPENSSO_BASE_URL . 'UI/Login');
define('OPENSSO_LOGOUT_URL',     OPENSSO_BASE_URL . 'UI/Logout');
define('OPENSSO_IS_TOKEN_VALID', OPENSSO_BASE_URL .
		'identity/isTokenValid');
define('OPENSSO_ATTRIBUTES',     OPENSSO_BASE_URL . 'identity/attributes');
define('OPENSSO_COOKIE_NAME_FETCH',     OPENSSO_BASE_URL .
		'identity/getCookieNameForToken');
define('OPENSSO_DOMAIN', ".us.es");


// Certificados
define('VALIDATE_CERT', TRUE);
define('CRT_SERIALNUMBER', '210592524451737690364240169455244055745');

