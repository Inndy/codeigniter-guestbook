<?php
$this->load->helper('url');
foreach($posts as $post):
?>
<div class="post">
    <p><span class="field-name">作者</span><?=html_escape($post->author)?></p>
    <p><span class="field-name">時間</span><?=html_escape($post->time)?></p>
    <p><span class="field-name">標題</span><?=html_escape($post->title)?></p>
    <p><span class="field-name">內容</span><?=html_escape($post->content)?></p>
    <p><a href="<?=base_url('posts/delete/' . $post->id)?>" class="button">刪除</a></p>
</div>
<?php endforeach; ?>
