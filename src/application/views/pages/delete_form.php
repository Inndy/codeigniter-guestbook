<?php
    $this->load->helper('form');
    $this->load->helper('url');
?>

<?=form_open(current_url(), ['class' => 'form'])?>
    <div>
        <label for="form_title">標題</label>
        <?=form_input([
            'name' => 'title',
            'id' => 'form_title',
            'readonly' => 'readonly'
        ], $post->title)?>
    </div>

    <div>
        <label for="form_del_pwd">刪除密碼</label>
        <?=form_password([
            'name' => 'del_pwd',
            'id' => 'form_del_pwd'
        ], $del_pwd)?>
    </div>

    <div>
        <?=form_submit([], '確認刪除')?>
    </div>
</form>
