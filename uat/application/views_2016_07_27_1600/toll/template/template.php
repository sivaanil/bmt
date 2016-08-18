<?php 
$this->load->view('toll/template/header');
$this->load->view('toll/template/menu');

foreach ($views as $view) {
    $this->load->view($view);
}

$this->load->view('toll/template/footer');

?>