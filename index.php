<?php
require('lib/db.php');
@session_start(); 

$tenkh = ""; $mobile = "";
$email = ""; $address = "";
$loaithe = "";
//
//
if (isset($_POST['tenkh'])) {
    $tenkh = $_POST['tenkh'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['mobile'])) {
    $mobile = $_POST['mobile'];
}
if (isset($_POST['address'])) {
    $address = $_POST['address'];
}
if (isset($_POST['loaithe'])) {
    $loaithe = $_POST['loaithe'];
}
//
$insert = 0;
//
if ($tenkh != "") 
{
    $sql = "insert into tblWeb_KhachHangDangKyMemberCard(TenKH, DiDong, Email, DiaChi, TinhTrangID, MaLoaiThe, DaThanhToan, DaTraDu, TongTien, TienThucTra, TienKhuyenMai, TienDaTra, TienConPhaiThu, HTTT, GhiChuThanhToan, ThoiGianDangKy, ThoiGianCapNhat, MaNVXuLy) values(N'$tenkh', '$mobile', N'$email', N'$address', '0', '$loaithe', '0', '0', '0','0','0','0','0','','',getdate(),getdate(),'')";
    $conn->query($sql);

    $insert = 1;
}

if ($insert == 1) 
{
?>
    <script type="text/javascript">
        setTimeout('window.location="thankyou.php"', 0);
    </script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Caravelle - Membership System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/index.css" rel="stylesheet">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0" id="home">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0">Caravelle</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Trang chủ</a>
                        <a href="#about" class="nav-item nav-link">VỀ SẢN PHẨM</a>
                        <a href="#pricing" class="nav-item nav-link">COMBO ƯU ĐÃI</a>
                        <a href="#review" class="nav-item nav-link">TRẢI NGHIỆM KHÁCH HÀNG</a>
                        <a href="#contact" class="nav-item nav-link">LIÊN HỆ</a>
                        <a href="login.php" class="nav-item nav-link">ADMIN</a>
                    </div>
                    <!-- <a href="" class="btn btn-primary-gradient rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Start Free Trial</a> -->
                </div>
            </nav>

            <div class="container-xxl bg-primary hero-header">
                <div class="container px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-8 text-center px-4 text-lg-start">
                            <h1 class="text-gradient mb-4 animated slideInDown">Caravelle - chương trình thẻ cho khách hàng thân thiết</h1>
                            <p class="text-white pb-5 fs-4 animated slideInDown">
                                Trải nghiệm các dịch vụ của Mai House với các ưu đãi hấp dẫn thông qua việc đăng ký thẻ thành viên, với nhiều tiện ích và lợi ích bất ngờ
                            </p>
                            <a href="#registerEcard"
                                class="btn btn-warning text-warning bg-transparent fs-5 py-sm-3 px-5 py-3 px-sm-5 me-3 rounded-pill animated fadeInUp">
                                ĐĂNG KÝ NGAY !
                            </a>
                            <!-- <a href="" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Contact Us</a> -->
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center justify-content-lg-end wow fadeInUp"
                            data-wow-delay="0.3s">
                            <!-- <div class="owl-carousel screenshot-carousel">
                                <img class="img-fluid" src="img/screenshot-1.png" alt="">
                                <img class="img-fluid" src="img/screenshot-2.png" alt="">
                                <img class="img-fluid" src="img/screenshot-3.png" alt="">
                                <img class="img-fluid" src="img/screenshot-4.png" alt="">
                                <img class="img-fluid" src="img/screenshot-5.png" alt="">
                            </div> -->
                            <img class="px-4" src="./img/header_banner.png" alt="hero_banner" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- About Start -->
        <!-- <div class="container-xxl py-5" id="about">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="text-primary-gradient fw-medium">About App</h5>
                        <h1 class="mb-4">#1 App For Your Fitness</h1>
                        <p class="mb-4">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita
                            erat ipsum et lorem et sit, sed stet no labore lorem sit clita duo justo eirmod magna dolore
                            erat amet</p>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="d-flex">
                                    <i class="fa fa-cogs fa-2x text-primary-gradient flex-shrink-0 mt-1"></i>
                                    <div class="ms-3">
                                        <h2 class="mb-0" data-toggle="counter-up">1234</h2>
                                        <p class="text-primary-gradient mb-0">Active Install</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="d-flex">
                                    <i class="fa fa-comments fa-2x text-secondary-gradient flex-shrink-0 mt-1"></i>
                                    <div class="ms-3">
                                        <h2 class="mb-0" data-toggle="counter-up">1234</h2>
                                        <p class="text-secondary-gradient mb-0">Clients Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill mt-3">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/about.png">
                    </div>
                </div>
            </div>
        </div> -->
        <!-- About End -->


        <!-- Features Start -->
        <!-- <div class="container-xxl py-5" id="feature">
            <div class="container py-5 px-lg-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-primary-gradient fw-medium">App Features</h5>
                    <h1 class="mb-5">Awesome Features</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-eye text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">High Resolution</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-layer-group text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Retina Ready</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-edit text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Editable Data</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-shield-alt text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Fully Secured</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-cloud text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Cloud Storage</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-mobile-alt text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Fully Responsive</h5>
                            <p class="m-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet
                                diam sed stet lorem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Features End -->

        <!-- Item Card Start -->
        <div class="contenedorCards">
            <div class="card border-0 mt-5 bg-transparent wow fadeInUp">
                <div class="wrapper">
                    <div class="imgProd" style="background-image: url(./img/copper-member.png);">
                    </div>
                    <div class="infoProd">
                        <p class="nombreProd" style="color: rgb(172, 109, 0)">COPPER-MEMBER</p>
                        <p class="extraInfo">-Được đồng bộ dữ liệu về sở thích và hành vi để được phục vụ tốt nhất ở mọi
                            chi nhánh.<br>
                            -Được xướng tên bằng giọng nói trợ lý ảo khi checkin bằng thẻ hội viên (tính năng này có thể
                            tắt do có yêu cầu từ hội viên).
                        </p>
                        <button class="btn btn-dark bg-transparent text-black-50 px-3 mt-3">Chi tiết</button>
                    </div>
                </div>
            </div>
            <div class="card border-0 mt-5 bg-transparent wow fadeInUp">
                <div class="wrapper">
                    <div class="imgProd" style="background-image: url(./img/silver-member.png);">
                    </div>
                    <div class="infoProd">
                        <p class="nombreProd" style="color: rgb(184, 184, 184)">SILVER-MEMBER</p>
                        <p class="extraInfo">-Được đồng bộ dữ liệu về sở thích và hành vi để được phục vụ tốt nhất ở mọi
                            chi nhánh.<br>
                            -Được xướng tên bằng giọng nói trợ lý ảo khi checkin bằng thẻ hội viên (tính năng này có thể
                            tắt do có yêu cầu từ hội viên).<br>
                            -Được tặng voucher ưu đãi hàng tháng với những đơn vị liên kết.<br>
                        </p>
                        <button class="btn btn-dark bg-transparent text-black-50 px-3 mt-3">Chi tiết</button>
                    </div>
                </div>
            </div>
            <div class="card border-0 mt-5 bg-transparent wow fadeInUp">
                <div class="wrapper">
                    <div class="imgProd" style="background-image: url(./img/gold-member.png);">
                    </div>
                    <div class="infoProd">
                        <p class="nombreProd" style="color: rgb(245, 208, 3)">GOLD-MEMBER</p>
                        <p class="extraInfo">-Được đồng bộ dữ liệu về sở thích và hành vi để được phục vụ tốt nhất ở mọi
                            chi nhánh.<br>
                            -Được xướng tên bằng giọng nói trợ lý ảo khi checkin bằng thẻ hội viên (tính năng này có thể
                            tắt do có yêu cầu từ hội viên).<br>
                            -Được tặng voucher ưu đãi hàng tháng với những đơn vị liên kết.<br>
                            -Được tùy chọn người phục vụ (hoặc huấn luyện viên).<br>
                        </p>
                        <button class="btn btn-dark bg-transparent text-black-50 px-3 mt-3">Chi tiết</button>
                    </div>
                </div>
            </div>
            <div class="card border-0 mt-5 bg-transparent wow fadeInUp">
                <div class="wrapper">
                    <div class="imgProd" style="background-image: url(./img/diamond-member.png);">
                    </div>
                    <div class="infoProd">
                        <p class="nombreProd" style="color: rgb(163, 204, 200)">DIAMON-MEMBER</p>
                        <p class="extraInfo">-Được đồng bộ dữ liệu về sở thích và hành vi để được phục vụ tốt nhất ở mọi
                            chi nhánh.<br>
                            -Được xướng tên bằng giọng nói trợ lý ảo khi checkin bằng thẻ hội viên (tính năng này có thể
                            tắt do có yêu cầu từ hội viên).<br>
                            -Được tặng voucher ưu đãi hàng tháng với những đơn vị liên kết.<br>
                            -Được tùy chọn người phục vụ (hoặc huấn luyện viên).<br>
                            -Với thẻ cao cấp nhất sẽ được tích hợp tính năng card-visit 4.0 và được cấp tài khoản riêng
                            để quản lý thông tin card.
                        </p>
                        <button class="btn btn-dark bg-transparent text-black-50 px-3 mt-3">Chi tiết</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Item Card End -->
        <!-- fORM REGISTER -->
        <div id="registerEcard" class="text-center mt-5">
            <h1 class="py-4 text-warning">VUI LÒNG ĐĂNG KÝ NGAY TẠI ĐÂY</h1>
            <form action="" method="post" enctype="multipart/form-data"
                class="row mx-auto g-3 needs-validation justify-content-center">
                <div class="col-12 col-md-6">
                    <!-- <label for="validationCustom01" class="form-label">First name</label> -->

                    <input type="text" class="form-control py-3" name="tenkh" id="tenkh" placeholder="Họ và Tên"
                        required />
                    <div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <label for="validationCustom01" class="form-label">First name</label> -->

                    <input type="email" class="form-control py-3" name="email" id="email" placeholder="Email"
                        required />
                    <div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <label for="validationCustom01" class="form-label">First name</label> -->
                    <input type="number" class="form-control py-3" name="mobile" id="mobile" placeholder="Di động"
                        required />
                    <div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <label for="validationCustom01" class="form-label">First name</label> -->
                    <input type="text" class="form-control py-3" name="address" id="address"
                        placeholder="Địa chỉ nhận thẻ" required />
                    <div class="pt-2 ps-2 valid-feedback text-start">Đã đúng định dạng!</div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <label for="validationCustom01" class="form-label">First name</label> -->
                    <select class="form-control py-3" name="loaithe" id="loaithe">
                        <option value="V" selected>COPPER-MEMBER</option>
                        <option value="S">SILVER-MEMBER</option>
                        <option value="G">GOLD-MEMBER</option>
                        <option value="D">DIAMOND-MEMBER</option>
                    </select>
                </div>
                <div class="mb-3">
                    Vui lòng nhập chính xác số nhà, phường, thị xã, thành phố để chung tôi dễ dàng gửi thẻ đến cho bạn một cách nhanh nhất.
                </div>
                <button type="submit" name="sendmail" id="btnRegister"
                    class="col-md-6 col-6 border-0 rounded-2 fw-bold py-3 my-4"
                    style="background-color:#ffe28d;color: rgb(32, 32, 32)">GỬI ĐĂNG KÝ</button>

            </form>
        </div>
        <!-- END FORM REGISTER -->
        <!-- Back to Top -->
        <!-- <a href="/profile.html" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="fas fa-plus"></i></a> -->
    </div>
    <script>
        var forms = document.querySelector(".needs-validation");
        var btns = document.querySelector(".btn-success");
        btns.onclick = () => {
            if (!forms.checkValidity()) {
                forms.classList.add("was-validated");
            }
            false;
        };
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <!-- <script src="lib/waypoints/waypoints.min.js"></script> -->
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/readmore.js"></script>
    <script src="js/index.js"></script>
</body>

</html>