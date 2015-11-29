<?php $this->load->helper('form'); ?>
<?=form_open('posts/create')?>
    <div>
        <label for="form_author">作者：</label>
        <?=form_input([
            'name' => 'author',
            'id' => 'form_author'
        ], $author)?>
    </div>

    <div>
        <label for="form_title">標題：</label>
        <?=form_input([
            'name' => 'title',
            'id' => 'form_title'
        ], $title)?>
    </div>

    <div>
        <label for="form_content">內容：</label><br>
        <?=form_textarea([
            'name' => 'content',
            'id' => 'form_content'
        ], $content)?>
    </div>

    <div>
        <label for="form_del_pwd">刪除密碼：</label>
        <?=form_password([
            'name' => 'del_pwd',
            'id' => 'form_del_pwd'
        ], $del_pwd)?>
    </div>

    <div>
        <?=form_submit([], '送出留言')?>
    </div>
</form>
