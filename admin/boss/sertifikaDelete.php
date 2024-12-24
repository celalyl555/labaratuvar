<?php
 include("../../db.php");

try {
    

    // Silme işlemi
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM sertifika WHERE id = :id");
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
