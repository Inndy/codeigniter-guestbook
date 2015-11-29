<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Posts extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->helper('url');
		$this->load->model('Post_model');
		date_default_timezone_set('Asia/Taipei');
	}

    private function render($f) {
        $this->load->view('template/header');
        $f();
        $this->load->view('template/footer');
    }

    private function display_posts($posts) {
        $this->render(function() use ($posts) {
            $this->load->view('pages/post', ["posts" => $posts]);
        });
    }

    private function display_post($post) {
        $this->display_posts([$post]);
    }

	public function create() {
        if(!isset($_POST['title']) ||
            (strlen($_POST['title']) == 0 || strlen($_POST['content']) == 0)) {
            $data = [
                'author' => 'Inndy',
                'title' => '測試留言' . time(),
                'content' => 'ajaksdjfaklsdf',
                'del_pwd' => 'admin'
            ];
            $this->render(function() use ($data) {
                $this->load->view('pages/post_form', $data);
            });
            return;
		}

		$post = new $this->Post_model($_POST); // author, title, content, del_pwd
		$post->time = date("Y-m-d H:i:s");
		$ret = $post->insert();
        if($ret) {
            redirect('/posts/view/' . $post->id);
        } else {
            $this->render(function() {
                $this->load->view('component/error_message', ['msg' => '留言失敗']);
                $this->load->view('pages/post_form', $_POST);
            });
        }
	}

	public function latest($count = 3) {
        $posts = $this->Post_model->get_last($count);

        $this->display_posts($posts);
	}

    public function index() {
        $posts = $this->Post_model->get_all();
        $this->display_posts($posts);
    }

    public function view($id) {
        $post = $this->Post_model->find($id);
        $this->display_post($post);
    }

    public function edit($id) {
        $post = $this->Post_model->find($id);
        if(!$post) {
            $this->render(function() {
                $this->load->view('component/error_message', ['msg' => '留言不存在']);
            });
            return;
        }
        if(!isset($_POST['del_pwd'])) {
            $data = json_decode(json_encode($post), true); // to hash-array
            unset($data['del_pwd']);
            $data['post_url'] = current_url();

            $this->render(function() use ($data) {
                $this->load->view('pages/post_form', $data);
            });
        } else {
            if($_POST['del_pwd'] === $post->del_pwd) {
                $post = new $this->Post_model($_POST);
                $ret = $post->update($id);
                $this->render(function() use ($ret) {
                    $this->load->view('component/message', ['msg' => '儲存成功']);
                });
            } else {
                $this->render(function() {
                    $this->load->view('component/error_message', ['msg' => '密碼錯誤']);
                    $this->load->view('pages/post_form', $_POST);
                });
            }
        }
    }

    public function delete($id) {
        $post = $this->Post_model->find($id);
        if(!$post) {
            $this->render(function() {
                $this->load->view('component/error_message', ['msg' => '該留言不存在']);
            });
            return;
        }
        if(isset($_POST['del_pwd'])) {
            if($_POST['del_pwd'] === $post->del_pwd) {
                $this->Post_model->delete($id);
                $this->render(function() {
                    $this->load->view('component/message', ['msg' => '刪除成功']);
                });
                return;
            } else {
                $this->render(function() use ($post) {
                    $this->load->view('component/error_message', ['msg' => '密碼錯誤']);
                    $this->load->view('pages/delete_form', ["post" => $post]);
                });
                return;
            }
        }
        $this->render(function() use ($post) {
            $this->load->view('pages/delete_form', ["post" => $post]);
        });
    }
}
