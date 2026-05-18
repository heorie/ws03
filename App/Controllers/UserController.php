<?php

namespace App\Controllers;

use Framework\Database;

class UserController
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database(require basePath('config/db.php'));
    }

    /* ── LOGIN FORM ─────────────────────────────────────── */
    public function login(array $params = []): void
    {
        if (isAuthenticated()) redirect('/');
        loadView('users/login');
    }

    /* ── AUTHENTICATE ───────────────────────────────────── */
    public function authenticate(array $params = []): void
    {
        $email    = sanitize($_POST['email']    ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];
        if (empty($email))    $errors['email']    = 'Email is required.';
        if (empty($password)) $errors['password'] = 'Password is required.';

        if (!empty($errors)) {
            loadView('users/login', ['errors' => $errors, 'email' => $email]);
            return;
        }

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->fetch();

        if (!$user || !password_verify($password, $user->password)) {
            loadView('users/login', [
                'errors' => ['auth' => 'Invalid email or password. Please try again.'],
                'email'  => $email,
            ]);
            return;
        }

        $_SESSION['user_id']   = $user->id;
        $_SESSION['user_name'] = $user->name;

        $_SESSION['flash'] = ['type' => 'success', 'message' => "Welcome back, {$user->name}!"];
        redirect('/');
    }

    /* ── REGISTER FORM ──────────────────────────────────── */
    public function register(array $params = []): void
    {
        if (isAuthenticated()) redirect('/');
        loadView('users/register');
    }

    /* ── STORE (register) ───────────────────────────────── */
    public function store(array $params = []): void
    {
        $name     = sanitize($_POST['name']     ?? '');
        $email    = sanitize($_POST['email']    ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['password_confirm'] ?? '';

        $errors = [];
        if (empty($name))     $errors['name']     = 'Full name is required.';
        if (empty($email))    $errors['email']    = 'Email address is required.';
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if (empty($password)) $errors['password'] = 'Password is required.';
        if (strlen($password) < 6) $errors['password'] = 'Password must be at least 6 characters.';
        if ($password !== $confirm) $errors['password_confirm'] = 'Passwords do not match.';

        if (!empty($errors)) {
            loadView('users/register', ['errors' => $errors, 'name' => $name, 'email' => $email]);
            return;
        }

        $existing = $this->db->query('SELECT id FROM users WHERE email = :email', ['email' => $email])->fetch();
        if ($existing) {
            loadView('users/register', [
                'errors' => ['email' => 'An account with this email already exists.'],
                'name'   => $name,
                'email'  => $email,
            ]);
            return;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query(
            'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)',
            ['name' => $name, 'email' => $email, 'password' => $hashed]
        );

        $_SESSION['user_id']   = $this->db->conn->lastInsertId();
        $_SESSION['user_name'] = $name;

        $_SESSION['flash'] = ['type' => 'success', 'message' => "Welcome to Jobseek, {$name}!"];
        redirect('/');
    }

    /* ── LOGOUT ─────────────────────────────────────────── */
    public function logout(array $params = []): void
    {
        session_unset();
        session_destroy();
        redirect('/login');
    }
}
