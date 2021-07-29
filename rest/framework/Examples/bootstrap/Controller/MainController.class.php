<?php
namespace Controller;


class MainController
{
    public function sessionAnalyzer() {
        //Todo: Validate your session and security
    }

    public function index() {
        return "Hello World";
    }

    public function notFound() {
        return 'This method is not found or is not allowed';
    }
}