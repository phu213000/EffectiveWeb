<?php require './config/config.php'; ?>
<?php 
if ($conn) {
    $products = $conn->query("SELECT * FROM products");
    $allProducts = $products->fetchAll(PDO::FETCH_ASSOC);
} else {
    die('Kết nối thất bại');
}
?> 

<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5c5946fe44.js" crossorigin="anonymous"></script>
    <style>
      .card-description {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
      }
    </style>
    <title>Trang Thanh Toán</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container" style="margin-top: none">
        <a class="navbar-brand text-white" href="#">Trang Thanh Toán</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-5">
        <?php foreach ($allProducts as $product) : ?>
        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
          <div class="card">
            <img height="213px" class="card-img-top" src="images/<?php echo $product['image']; ?>" alt="Hình Ảnh Sản Phẩm">
            <div class="card-body">
              <h5 class="d-inline"><b><?php echo $product['title']; ?></b></h5>
              <h5 class="d-inline"><div class="text-muted d-inline">($<?php echo $product['price']; ?>/sản phẩm)</div></h5>
              <p class="card-description"><?php echo $product['description']; ?></p> 
              <a href="#" class="btn btn-primary w-100 rounded my-2">Thanh Toán Ngay <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <br>
      
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Liên Kết</h5>
        <ul class="list-unstyled mb-0">
          <li><a href="#!" class="text-white">Liên Kết 1</a></li>
          <li><a href="#!" class="text-white">Liên Kết 2</a></li>
          <li><a href="#!" class="text-white">Liên Kết 3</a></li>
          <li><a href="#!" class="text-white">Liên Kết 4</a></li>
        </ul>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-0">Liên Kết</h5>
        <ul class="list-unstyled">
          <li><a href="#!" class="text-white">Liên Kết 1</a></li>
          <li><a href="#!" class="text-white">Liên Kết 2</a></li>
          <li><a href="#!" class="text-white">Liên Kết 3</a></li>
          <li><a href="#!" class="text-white">Liên Kết 4</a></li>
        </ul>
      </div>
      
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Bản quyền:
      <a class="text-white" href="https://mdbootstrap.com/">Ho Truong Minh Phu
