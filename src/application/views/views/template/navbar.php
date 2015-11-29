<?php
    $this->load->helper('url');
    $links = [
        '首頁' => '/',
        '新增留言' => '/posts/create'
    ];
?>
<nav class="navbar">
    <?php
    foreach($links as $link => $to) {
        echo anchor($to, $link, ['class' => 'nav-item']);
    }
    ?>
</nav>
