<?php
session_start();

require_once 'config/db.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'login') {
        require_once 'controllers/authController.php';
        login();
    } elseif ($action === 'welcome') {
        require_once 'controllers/authController.php';
        welcome();
    } elseif ($action === 'update_password') {
        require_once 'controllers/authController.php';
        updatePassword();
    } elseif ($action === 'borrow_book') {
        require_once 'controllers/userController.php';
        borrowBook();
    } elseif ($action === 'update_profile') {
        require_once 'controllers/userController.php';
        updateProfile();
    } elseif ($action === 'manage_books') {
        require_once 'controllers/adminController.php';
        manageBooks();
    } elseif ($action === 'return_book') {
        require_once 'controllers/adminController.php';
        returnBook();
    } elseif ($action === 'add_book') {
        require_once 'controllers/adminController.php';
        addBook();
    } elseif ($action === 'edit_book') {
        require_once 'controllers/adminController.php';
        editBook();
    } elseif ($action === 'delete_book') {
        require_once 'controllers/adminController.php';
        deleteBook();
    } elseif ($action === 'manage_members') {
        require_once 'controllers/adminController.php';
        manageMembers();
    }  elseif ($action === 'add_member') {
        require_once 'controllers/adminController.php';
        addMember();
    } elseif ($action === 'edit_member') {
        require_once 'controllers/adminController.php';
        editMember();
    } elseif ($action === 'delete_member') {
        require_once 'controllers/adminController.php';
        deleteMember();
    } elseif ($action === 'generate_reports') {
        require_once 'controllers/adminController.php';
        generateReports();
    } elseif ($action === 'logout') {
        require_once 'logout.php';
        logout();
    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
} else {
    // Jika tidak ada action, redirect ke halaman login
    header('Location: login.php');
}
?>
