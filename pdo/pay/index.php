<?php require './config/config.php'; ?>
<?php 
if ($conn) {
    $products = $conn->query("SELECT * FROM products");
    $products->execute();
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/5c5946fe44.js" crossorigin="anonymous"></script>
    <title>Trang Thanh Toán</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container">
        <a class="navbar-brand text-white" href="#">Trang Thanh Toán</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Add any additional nav items here if needed -->
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-5">
        <?php foreach ($allProducts as $product) : ?>
        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mb-4">
          <div class="card h-100">
            <img height="213px" class="card-img-top" src="images/<?php echo $product['image']; ?>" alt="Hình Ảnh Sản Phẩm">
            <div class="card-body d-flex flex-column">
              <h5 class="d-inline"><b><?php echo $product['title']; ?></b></h5>
              <h5 class="d-inline"><div class="text-muted d-inline">($<?php echo $product['price']; ?>/sản phẩm)</div></h5>
              <p class="card-description"><?php echo $product['description']; ?></p> 
              <a href="pay.php?product_id=<?php echo $product['id']; ?>&product_title=<?php echo urlencode($product['title']); ?>&product_price=<?php echo $product['price']; ?>" class="btn btn-primary w-100 rounded mt-auto">Thanh Toán Ngay <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <footer class="text-center text-lg-start">
      <div class="container p-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0 footer-links">
            <h5 class="text-uppercase">Liên Kết</h5>
            <ul class="list-unstyled">
              <li><a href="#!" class="text-white">Về Chúng Tôi</a></li>
              <li><a href="#!" class="text-white">Dịch Vụ</a></li>
              <li><a href="#!" class="text-white">Liên Hệ</a></li>
              <li><a href="#!" class="text-white">Chính Sách Bảo Mật</a></li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0 footer-links">
            <h5 class="text-uppercase">Kết Nối Với Chúng Tôi</h5>
            <ul class="list-unstyled">
              <li><a href="#!" class="text-white">Facebook</a></li>
              <li><a href="#!" class="text-white">Instagram</a></li>
              <li><a href="#!" class="text-white">Twitter</a></li>
              <li><a href="#!" class="text-white">LinkedIn</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Bản quyền:
        <a class="text-white" href="https://mdbootstrap.com/">Ho Truong Minh Phu</a>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
