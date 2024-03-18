<?php
    include '../api/db.php';
    if ($_POST) {
        if (isset($_SESSION['userPhone'])) {
            $delete = $db->prepare('DELETE FROM numaralar WHERE numara = ? LIMIT 1');
            $delete->execute(array($_SESSION['userPhone']));
            $json = array(
                'status' => 'success',
                'message' => 'Bonus hakkı iptal edildi.'
            );
        } else {
            $json = array(
                'status' => 'error',
                'message' => 'Numara bulunamadı'
            );
        }
        
        echo json_encode($json);
        header('Content-Type:application/json');
    }

?>