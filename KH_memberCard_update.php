<?php 
require('lib/db.php');
require('functions/lichsuphieu.php');
@session_start();

$manv = $_SESSION['MaNV'];

$stt = ""; $tenkh = ""; $didong = ""; $diachi = ""; $email = "";

if(isset($_POST['stt'])) 
{
    $stt = $_POST['stt']; 
    //
    //
    $tenkh = $_POST['tenkh']; $diachi = $_POST['diachi']; $didong = $_POST['didong']; $email = $_POST['email']; 

    $sql = "Update tblWeb_KhachHangDangKyMemberCard set TenKH = N'$tenkh', DiDong = N'$didong', DiaChi = N'$diachi', Email = '$email' Where Stt like '$stt'";
    $conn->query($sql);

}//end if POST["stt"]

?>
<script>
  setTimeout('window.location="KH_eCard.php"',0);
</script>

