<?php
include 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$decoded = JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHRlcm5hbF9pZCI6IjQ4MDgwMSIsImVtYWlsIjoiZXJheS5ia2FueW9uQGhvdG1haWwuY29tIiwiaWF0IjoxNTY5MTY4MDI3LCJuYW1lIjoidGVzdHcgaW5uZ2cifQ.phnTZ28NJHgcsNOrcpphXyzxJOADMuS9WJJNYRssHcA', '3EF97E3AE324FDA34C73551407D9C39B7AD670D2ABD80A84882B052E09F19B0C', array('HS256'));

print_r($decoded);