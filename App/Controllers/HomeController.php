<?php

namespace App\Controllers;

use Framework\Database;
 
class HomeController
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database(require basePath('config/db.php'));
    }

    public function index(array $params = []): void
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();
        loadView('home', ['listings' => $listings]);
    }
}
