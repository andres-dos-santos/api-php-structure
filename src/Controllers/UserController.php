<?php

namespace Controllers;

use Services\UserService;

class UserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(): void
    {
        $users = $this->service->getAll();
        $this->json($users);
    }

    public function show(int $id): void
    {
        $user = $this->service->getById($id);

        if (!$user) {
            $this->json(['error' => 'User not found'], 404);
            return;
        }

        $this->json($user);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name'])) {
            $this->json(['error' => 'Name is required'], 400);
            return;
        }

        $user = $this->service->create($data);
        $this->json($user, 201);
    }

    private function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
