<?php 
    class SP {
        public $productID;
        public $size;
        public $color;
        public $price;
        public $name_product;
        public $type;
        public $img;
        public $brand;
        //Hàm khởi tạo mặc định
        public function __construct($productID, $size, $color, $price, $name_product, $type, $img, $brand)
        {
            $this->productID = $productID;
            $this->size = $size;
            $this->color = $color;
            $this->price = $price;
            $this->name_product = $name_product;
            $this->type = $type;
            $this->img = $img;
            $this->brand = $brand;
        }
        function get_color( $color) {
            $color = explode(',', $color);
            return $color;
        }
        function get_img( $img ) {
            $img = explode(',', $img);
            return $img;
        }
    }
?>