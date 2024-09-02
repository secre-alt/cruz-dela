<?php
session_start();

if (!isset($_SESSION['display'])) {
    $_SESSION['display'] = '';
}

if (isset($_POST['num']) || isset($_POST['operation'])) {
    if (isset($_POST['num'])) {
        $_SESSION['display'] .= $_POST['num'];
    } elseif (isset($_POST['operation'])) {
        if ($_SESSION['display'] !== '' && !in_array(substr($_SESSION['display'], -1), ['+', '-', '*', '/'])) {
            $_SESSION['display'] .= $_POST['operation'];
        }
    }
}

if (isset($_POST['clear'])) {
    $_SESSION['display'] = '';
}

if (isset($_POST['submit']) && $_POST['submit'] === 'calculate') {
    try {
        $result = eval('return ' . $_SESSION['display'] . ';');
        $_SESSION['display'] = $result;
    } catch (Exception $e) {
        $_SESSION['display'] = 'Error';
    }
}

header('Location: index.php');
exit();
?>
