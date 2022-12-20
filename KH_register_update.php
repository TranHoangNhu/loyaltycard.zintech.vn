<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
@session_start();

$manv = $_SESSION['MaNV'];

$kh = new clsKhachHang($conn);

$stt = ""; $tenkh = ""; $didong = ""; $diachi = ""; 
$email = ""; $tinhtrangid = ""; $tongtien = 0; $maloaithe = "";

if(isset($_POST['stt'])) 
{
    $stt = $_POST['stt']; 
    //
    //
    $tenkh = $_POST['tenkh']; $diachi = $_POST['diachi']; $didong = $_POST['didong']; $email = $_POST['email']; 
    $tinhtrangid = $_POST['tinhtrang']; $maloaithe = $_POST['loaithe']; 

    $sql = "Update tblWeb_KhachHangDangKyMemberCard set TenKH = N'$tenkh', DiDong = N'$didong', Email = N'$email', DiaChi = N'$diachi', TongTien = '$tongtien', MaLoaiThe = '$maloaithe' Where Stt like '$stt'";
    $conn->query($sql);

    if($tinhtrangid == "1")
    {
        //1. tao ma kh -> insert tblDMKHNCC
        //2. tao ma the vip -> insert tblKhachHang_TheVip
        //3. insert tai khoan the -> insert tblTheVip_GhiNoTT
        //
        $makh = "";
        $makh = $kh->insertNewClient($tenkh, $diachi, $didong, $email, $manv);
        //
        //
        if($makh != "" && $maloaithe != "")
        {
            $is_ghinodv = 0; $is_ghinott = 0;
            $mathevip = $kh->insertNewClientCard($makh, $maloaithe, $is_ghinodv, $is_ghinott, $manv);
            //
            //echo "ma the: ".$mathevip; //ok
            //
            /*
            if($mathevip != "" && $tongtien > 0)
            {
                //3. insert tai khoan the 
                $kh->insertGhiNoTT($mathevip, $tenkh, $tongtien, $manv);
            }
            */
        }
        //
        //
        if($makh != "")
        {
            $sql = "Update tblWeb_KhachHangDangKyMemberCard set TinhTrangID = '1' Where Stt like '$stt'";
            $conn->query($sql);
        }
    }

}//end if POST["stt"]

?>
<script>
  setTimeout('window.location="KH_register.php"',0);
</script>