<?php
session_start();

if (!isset($_SESSION['display'])) {
    $_SESSION['display'] = '0';
}

if (isset($_POST['clear'])) {
    $_SESSION['display'] = '0';
} elseif (isset($_POST['num'])) {
    
    if ($_SESSION['display'] === '0' || $_SESSION['display'] === 'error') {
        $_SESSION['display'] = $_POST['num'];
    } else {
        $_SESSION['display'] .= $_POST['num'];
    }
} elseif (isset($_POST['operation'])) {

    if ($_SESSION['display'] !== 'Error') {
    $_SESSION['display'] .= ' ' . $_POST['operation'] . ' ';
    }
} elseif (isset($_POST['submit'])) {
    $expression = $_SESSION['display'];
    $result = calculateExpression($expression);

    if ($result !== false) {
        $_SESSION['display'] = $result;
    } else {
        $_SESSION['display'] = 'Error';
    }
}

echo isset($_SESSION['display']) ? $_SESSION['display'] : '0';

function calculateExpression($expression) {
    $tokens = explode(' ', $expression);
    
    if (count($tokens) < 3) {
        return false;
    }

    $result = floatval($tokens[0]);
    for ($i = 1; $i < count($tokens); $i += 2) {
        $operator = $tokens[$i];
        $operand = floatval($tokens[$i + 1]);

        switch ($operator) {
            case '+':
                $result += $operand;
                break;
            case '-':
                $result -= $operand;
                break;
            case '×':
                $result *= $operand;
                break;
            case '÷':
                if ($operand == 0) {
                    return false;
                }
                $result /= $operand;
                break;
            default:
                return false;
        }
    }

    return $result;
}
?>
