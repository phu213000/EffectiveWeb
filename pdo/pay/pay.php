<?php
require "./config/config.php";

if(isset($_GET['product_id'])){
  $id = $_GET['product_id'];
  $product = $conn->prepare("SELECT * FROM products WHERE id = :id");
  $product->bindParam(':id', $id, PDO::PARAM_INT);
  $product->execute();
  $singleProduct = $product->fetch(PDO::FETCH_ASSOC);
  
  if(!$singleProduct) {
    die('Product not found');
  }
} else {
  die('Product ID is missing');
}
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal JS SDK Standard Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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

    <div class="container mt-5">
      <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">
          <h2 class="mb-4">Thanh toán cho sản phẩm: <?php echo htmlspecialchars($singleProduct['title']); ?></h2>
          <h4 class="mb-4">Giá: $<?php echo htmlspecialchars($singleProduct['price']); ?></h4>
          <div id="paypal-button-container"></div>
          <p id="result-message" class="mt-3"></p>
        </div>
      </div>
    </div>

    <footer class="text-center text-lg-start mt-4">
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

    <!-- Initialize the JS-SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Adjqgz4q5y7iVRnTjcRX3UtOQ8-j64kQwAFW9Ca3Cue99wRonhMuf7T28SSloIQsbokMpQNifLp7G96z&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo" data-sdk-integration-source="developer-studio"></script>
    <script>
      window.paypal.Buttons({
        style: {
          shape: "rect",
          layout: "vertical",
          color: "gold",
          label: "paypal",
        },
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $singleProduct['price']; ?>'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
      }).render("#paypal-button-container");
    </script>
  </body>
</html>
