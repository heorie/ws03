<?php

function basePath(string $path = ''): string
{
    return __DIR__ . '/' . ltrim($path, '/');
}


function url(string $path = ''): string
{

    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'), '/\\');
    if ($scriptDir === '.') $scriptDir = '';

    $path = '/' . ltrim($path, '/');
    return $scriptDir . $path;
}


function loadView(string $name, array $data = []): void
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (!file_exists($viewPath)) {
        throw new \Exception("View [{$name}] not found at {$viewPath}");
    }

    extract($data);
    require $viewPath;
}


function loadPartial(string $name, array $data = []): void
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (!file_exists($partialPath)) {
        throw new \Exception("Partial [{$name}] not found.");
    }

    extract($data);
    require $partialPath;
}


function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}


function sanitize(string $dirty): string
{
    return htmlspecialchars(strip_tags(trim($dirty)), ENT_QUOTES, 'UTF-8');
}


function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}


function isAuthenticated(): bool
{
    return isset($_SESSION['user_id']);
}



function formatSalary(mixed $salary): string
{
    if (!$salary) return 'N/A';
    return '$' . number_format((float) $salary);
}


function inspect(mixed $value): void
{
    echo '<pre style="background:#1e293b;color:#e2e8f0;padding:1rem;border-radius:8px;overflow:auto;">';
    var_dump($value);
    echo '</pre>';
}