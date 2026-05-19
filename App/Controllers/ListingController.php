<?php

namespace App\Controllers;

use Framework\Database;

class ListingController
{
    protected Database $db;

    private array $allowedFields = [
        'title', 'description', 'salary', 'requirements',
        'benefits', 'company', 'address', 'city', 'state',
        'phone', 'email', 'tags',
    ];

    public function __construct()
    {
        $this->db = new Database(require basePath('config/db.php'));
    }

    /* ── INDEX ─────────────────────────────────────────── */
    public function index(array $params = []): void
    {
        $keywords = trim($_GET['keywords'] ?? '');
        $location = trim($_GET['location'] ?? '');

        $query  = 'SELECT * FROM listings WHERE 1=1';
        $qParams = [];

        if ($keywords !== '') {
            $query .= ' AND (title LIKE :kw1 OR description LIKE :kw2 OR tags LIKE :kw3)';
            $qParams['kw1'] = '%' . $keywords . '%';
            $qParams['kw2'] = '%' . $keywords . '%';
            $qParams['kw3'] = '%' . $keywords . '%';
        }
        if ($location !== '') {
            $query .= ' AND (city LIKE :loc1 OR state LIKE :loc2)';
            $qParams['loc1'] = '%' . $location . '%';
            $qParams['loc2'] = '%' . $location . '%';
        }

        $query .= ' ORDER BY created_at DESC';

        $listings = $this->db->query($query, $qParams)->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
            'keywords' => $keywords,
            'location' => $location,
        ]);
    }

    /* ── CREATE ─────────────────────────────────────────── */
    public function create(array $params = []): void
    {
        if (!isAuthenticated()) {
            ErrorController::notAuthorized('Please log in to post a job listing.');
            return;
        }
        loadView('listings/create');
    }

    /* ── STORE ──────────────────────────────────────────── */
    public function store(array $params = []): void
    {
        if (!isAuthenticated()) {
            ErrorController::notAuthorized();
            return;
        }

        $data   = [];
        $errors = [];

        foreach ($this->allowedFields as $field) {
            $data[$field] = sanitize($_POST[$field] ?? '');
        }

        if (empty($data['title']))       $errors['title']       = 'Job title is required.';
        if (empty($data['description'])) $errors['description'] = 'Job description is required.';
        if (empty($data['email']))       $errors['email']       = 'Contact email is required.';
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        if (!empty($errors)) {
            loadView('listings/create', ['errors' => $errors, 'listing' => (object) $data]);
            return;
        }

        $data['user_id'] = $_SESSION['user_id'];

        $fields       = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $this->db->query("INSERT INTO listings ({$fields}) VALUES ({$placeholders})", $data);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Job listing created successfully!'];
        redirect('/listings');
    }

    /* ── SHOW ───────────────────────────────────────────── */
    public function show(array $params = []): void
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found.');
            return;
        }

        loadView('listings/show', ['listing' => $listing]);
    }
 
    /* ── EDIT ───────────────────────────────────────────── */
    public function edit(array $params = []): void
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found.');
            return;
        }

        if (!isAuthenticated() || $_SESSION['user_id'] != $listing->user_id) {
            ErrorController::notAuthorized('You can only edit your own listings.');
            return;
        }

        loadView('listings/edit', ['listing' => $listing]);
    }

    /* ── UPDATE ─────────────────────────────────────────── */
    public function update(array $params = []): void
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found.');
            return;
        }

        if (!isAuthenticated() || $_SESSION['user_id'] != $listing->user_id) {
            ErrorController::notAuthorized('You can only edit your own listings.');
            return;
        }

        $data   = [];
        $errors = [];

        foreach ($this->allowedFields as $field) {
            $data[$field] = sanitize($_POST[$field] ?? '');
        }

        if (empty($data['title']))       $errors['title']       = 'Job title is required.';
        if (empty($data['description'])) $errors['description'] = 'Job description is required.';
        if (empty($data['email']))       $errors['email']       = 'Contact email is required.';
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        if (!empty($errors)) {
            loadView('listings/edit', ['errors' => $errors, 'listing' => (object) array_merge((array) $listing, $data)]);
            return;
        }

        $setParts = [];
        foreach (array_keys($data) as $field) {
            $setParts[] = "{$field} = :{$field}";
        }
        $setClause  = implode(', ', $setParts);
        $data['id'] = $id;

        $this->db->query("UPDATE listings SET {$setClause} WHERE id = :id", $data);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Listing updated successfully!'];
        redirect("/listings/{$id}");
    }

    /* ── DESTROY ────────────────────────────────────────── */
    public function destroy(array $params = []): void
    {
        $id      = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found.');
            return;
        }

        if (!isAuthenticated() || $_SESSION['user_id'] != $listing->user_id) {
            ErrorController::notAuthorized('You can only delete your own listings.');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', ['id' => $id]);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Listing deleted successfully.'];
        redirect('/listings');
    }
}
