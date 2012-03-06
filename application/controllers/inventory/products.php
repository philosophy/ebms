<?php
    class Products extends Items {

        function __construct() {
            parent::__construct();
            $product = new $this->Product_model();
        }

        function index() {                        
            $data['title'] = lang('product');
            $data['content'] = 'inventory/products/index';

            $this->parser->parse('layouts/application', $data);
            
            parent::enableProfiler();            
        }

        function browse() {

        }

    }
?>