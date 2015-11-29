<?php foreach($posts as $post): ?>
<div class="post">
    <p><span class="field-name">作者</span><?=html_escape($post->author)?></p>
    <p><span class="field-name">時間</span><?=html_escape($post->time)?></p>
    <p><span class="field-name">標題</span><?=html_escape($post->title)?></p>
    <p><span class="field-name">內容</span><?=html_escape($post->content)?></p>
</div>
<?php endforeach; ?>
