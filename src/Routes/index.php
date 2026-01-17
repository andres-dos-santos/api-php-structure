<?php

require_once __DIR__ . '/User.routes.php';

http_response_code(404);
echo json_encode(['error' => 'Route not found']);
