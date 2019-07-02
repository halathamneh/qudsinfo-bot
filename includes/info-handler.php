<?php
if ( ! $auth->isAuthenticated() ) {
    echo "error: not authenticated";
    die('not authenticated');
}
if ( isset($_POST['content']) && isset($_POST['send_date']) ) {
    
    if ( ! is_array($_POST['content']) ) {
        $info = [
            'content'   => $_POST['content'],
            'send_date' => $_POST['send_date'],
        ];
        addInfo($info, $_FILES['image']);
        redirect('information.php');
        
    } else {
        for ($i = 0; $i < count($_POST['content']); $i++) {
            $info = [
                'content'   => $_POST['content'][$i],
                'send_date' => $_POST['send_date'][$i],
            ];
            $image = [
                'name'  => $_FILES['image']['name'][$i],
                'tmp_name'  => $_FILES['image']['tmp_name'][$i],
                'size'  => $_FILES['image']['size'][$i],
                'error'  => $_FILES['image']['error'][$i],
            ];
            addInfo($info, $image);
        }
        redirect('information.php');
    }
    
}

function addInfo($info, $img) {
    global $bot;
    $content = $info['content'];
    $send_date = strtotime($info['send_date']);
    $img_url = '';
    if ( isset($img) && $img['size'] > 0 ) {
        $img_name = $img['name'];
        $img_ext = explode('.', $img_name);
        $img_ext = $img_ext[count($img_ext) - 1];
        $real_name = time() . '.' . $img_ext;
        $real_path = IMG_UPLOAD_PATH . $real_name;
        // upload image
        if ( move_uploaded_file($img['tmp_name'], $real_path) ) {
            $img_url = BOT_SITE_URL . 'info_images/' . $real_name;
        } else {
            die('error uploading');
        }
    }
    
    if ( !($result = $bot->saveInfo($content, $img_url, $send_date)) ) {
        var_dump($result);
        die();
    }
}