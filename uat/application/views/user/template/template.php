<?php 

$this->load->view('user/template/header');
$this->load->view('user/template/menu');

foreach ($views as $view) {
    $this->load->view($view);
}

$this->load->view('user/template/footer');

?>