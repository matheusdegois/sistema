<?php
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $imagens = [];
    for ($i = 1; $i <= 3; $i++) {
        $campo = 'img' . $i;
        $campo_antiga = $campo . '_antiga';
        $imagens[$campo] = '';
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION);
            $novo_nome = uniqid($campo . '_', true) . '.' . $ext;
            $destino = '../uploads/' . $novo_nome;
            if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
                $imagens[$campo] = $novo_nome;
            }
        } else if (isset($_POST[$campo_antiga])) {
            $imagens[$campo] = $_POST[$campo_antiga];
        }
    }

    $sql = $conn->prepare("UPDATE slides SET img1 = ?, img2 = ?, img3 = ?");
    $sql->execute([$imagens['img1'], $imagens['img2'], $imagens['img3']]);
    
    header('Location: slides-editar.php?sucesso=1&id=' . $id);
    exit;
} else {
    header('Location: slides-editar.php?erro=1');
    exit;
}
?>
