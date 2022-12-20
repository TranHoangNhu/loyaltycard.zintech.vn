<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');

@session_start();

$kh = new clsKhachHang($conn);
date_default_timezone_set('Asia/Bangkok');

if(!isset($_SESSION['TenSD'])) //------check session nhân viên, ko có thoát ra đăng nhập lại
{
?>
<script>
	setTimeout('window.location="login.php"',0);
</script>
<?php
}

$matrungtam = $_SESSION['MaTrungTam'];
$tentrungtam = $_SESSION['TenTrungTam']; 

$ngay = date("d"); $thang = date("m"); $nam = date("Y");

$timkiem = 0; $chinhsua = 0; $xoa = 0; $stt = "";
//
$tenkh = ""; $didong = ""; $diachi = ""; $email = ""; $maloaithe = "";


if(@$_GET['chinhsua'] != null)
{
    $chinhsua = @$_GET['chinhsua'];
}

if(@$_GET['xoa'] != null)
{
    $xoa = @$_GET['xoa'];
}

if(@$_GET['stt'] != null)
{
    $stt = @$_GET['stt'];
  
    $l_sql="select a.* from tblWeb_KhachHangDangKyMemberCard a Where a.Stt like '$stt'";
    try
    {
        $rs=$conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
        if($rs !== false)
        {
            foreach($rs as $r)
            {
                $r['TenKH']; $r['DiDong']; $r['DiaChi']; $r['Email']; $r['MaLoaiThe']; 

                $tenkh = $r['TenKH']; $email = $r['Email']; $didong = $r['DiDong']; $diachi = $r['DiaChi'];
                $maloaithe = $r['MaLoaiThe']; 
            }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
//
//
if($xoa == 1 && $stt != "")
{
    $sql = "Delete from tblWeb_KhachHangDangKyMemberCard Where Stt like '$stt'";
    $rs=$conn->query($sql);
    
    $xoa = 0;
}
//      ----- gia tri loc kh --------
//
$filter_kh = ""; $filter_phone = ""; $filter_timchinhxac = 0;
//

if(@$_GET['timkiem'] != null)
{
    $timkiem = @$_GET['timkiem'];
}

if($timkiem == 1)
{
    if(isset($_GET['filter_kh']))
    {
        $filter_kh = $_GET['filter_kh'];
        //echo "filter kh: ".$filter_kh;
    }
    //
    if(isset($_GET['filter_phone']))
    {
        $filter_phone = $_GET['filter_phone'];
        //echo "filter phone: ".$filter_phone;
    }
}

?>
<?php include 'header-register.php'; ?>
<body>
<div id="wrapper">
	 <?php include 'menu.php'; ?>
    <div id="page-wrapper">
      <div class="col-md-12 graphs">
	       <div class="xs">
            <form action="KH_eCard.php" method="GET">
                <div class="row">
                    <div class="col-md-4">
                    Name <input type="text" value="<?=$filter_kh?>" id="filter_kh" name="filter_kh" style="width:60%;" />
                    </div>
                    <div class="col-md-4">
                    Phone <input type="text" value="<?=$filter_phone?>" id="filter_phone" name="filter_phone" style="width:60%;"/>
                    </div>
                    
                    <div class="col-md-4">
                        <button type="submit" class="btn" style="background-color: green;color:white;margin-left: 70px;font-style: bold;font-weight: 100px;width: 100px;" name ="timkiem" value="1">Tìm</button>
                    </div>
                </div>
            </form>

<!--                                  The Modal 2 : sua thong tin                         -->
<div id="myModal2" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close2">&times;</span>
    <h3>SỬA THÔNG TIN THẺ</h3>
        <form action="KH_memberCard_update.php" method="post" >
        <div class="row">
                <div class="col-sm-3">Tên : </div>
                <div class="col-sm-9">
                    <input type="hidden" name="stt" value="<?php echo @$stt; ?>" style="width:100%;">
                    <input type="text" name="tenkh" value="<?php echo @$tenkh; ?>" style="width:100%;">
                </div>
        </div>
        <div class="row">
                <div class="col-sm-3">Di động : </div>
                <div class="col-sm-9">
                    <input type="text" name="didong" value="<?php echo @$didong; ?>" style="width:100%;">
                </div>
        </div>
        <div class="row">
                <div class="col-sm-3">Email : </div>
                <div class="col-sm-9">
                    <input type="text" name="email" value="<?php echo @$email; ?>" style="width:100%;">
                </div>
        </div>
        <div class="row">
                <div class="col-sm-3">Địa chỉ : </div>
                <div class="col-sm-9">
                    <input type="text" name="diachi" value="<?php echo @$diachi; ?>" style="width:100%;">
                </div>
        </div>
        <div class="row">
            <input type="submit" class="btn" name="btn_update" value="Cập nhật">
        </div>
    </form>
  </div>
</div>

<?php
if($chinhsua == 1)
{
    $chinhsua = 0; 
?>
    <script>
        // Get the modal
        var modal2 = document.getElementById('myModal2');

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close2")[0];

        modal2.style.display = "block";

        span2.onclick = function() {
            modal2.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal2) {
              modal2.style.display = "none";
            }
        }
    </script>
    <!--                          END THE MODAL 2                         -->
<?php
}//end if

/*-------------------- xu ly code để lấy total page cho viec phan trang -----------*/
//
/*code để lấy total page*/
if (isset($_GET['pageno_kh'])) {
       $pageno_kh = $_GET['pageno_kh'];
    } else {
        $pageno_kh = 1;
    }
    
  $total_pages_kh = 3;
  $no_of_records_per_page = 20;//6;
  $startRow = ($pageno_kh-1) * $no_of_records_per_page;
  $endpoint = $startRow + $no_of_records_per_page;

  $total_pages_sql = "select COUNT(*) as SoKH from tblWeb_KhachHangDangKyMemberCard Where TinhTrangID = '1'";
  $total_rows  = 0;
  try
  {
        $rs_total=$conn->query($total_pages_sql)->fetch();
        $total_rows=$rs_total['SoKH'];
        $total_pages_kh = ceil($total_rows / $no_of_records_per_page);
  }
  catch (Exception $e) 
  {
        echo $e->getMessage();
  }
  //
$totalKH = 0;
$kh_list = $kh->getMemberCardList($filter_kh, $filter_phone, $startRow, $endpoint, $totalKH);

$kh_arr = array();

foreach($kh_list as $r)
{
  $kh_arr[] = [
        'Stt' => $r['Stt'], 
        'TenKH' => $r['TenKH'], 
        'DiDong' => $r['DiDong'], 
        'Email' => $r['Email'], 
        'DiaChi' => $r['DiaChi'],
        'TinhTrangID' => $r['TinhTrangID'], 
        'MaLoaiThe' => $r['MaLoaiThe'], 
        'TenLoaiThe' => $r['TenLoaiThe']
    ];
}

$stttemp = "";
//$kh_list =  customizeArrayKH_Register( $kh_arr );

?>

<div class="row">
        Tổng số khách hàng: <?php echo $totalKH."/".number_format($total_rows,0,',','.'); ?>
</div>
	         <div class="row">
		          <div class="col-md-12">
                <table class="table">
                <thead>
                  <tr>
                    <th>Tên</th>    
                    <th>Di động</th>    
                    <th>Email</th>    
                    <th>Địa chỉ</th>    
                    <th>Tên Loại Thẻ</th>
                    <th>Sửa</th>
                  </tr>
            </thead>
            <tbody>
<?php 

foreach( $kh_list as $k )
{
    $stttemp = $k['Stt'];// $k->Stt;
?>
          <tr class="success">
              <td><?php echo $k['TenKH'];//$k->TenKH;?></td>
              <td><?php echo $k['DiDong'];//$k->DiDong;?></td>      
              <td><?php echo $k['Email'];//$k->Email;?></td>     
              <td><?php echo $k['DiaChi'];//$k->DiaChi;?></td>
              <td><?php echo $k['TenLoaiThe'];//$k->CongTy;?></td> 
              <td><a href="KH_eCard.php?stt=<?php echo $k['Stt'];//$k->Stt; ?>&chinhsua=1">Sửa</a></td>
          </tr>
<?php 
}
?>

<script>
$(document).ready(function() {

  var selectedKTV = $('#ktv_list_selected');
 $('#ktv_list_selected').remove();

 var orderTour = $('#ktv_list_tour_order');
 $('#ktv_list_tour_order').remove();

  $.noConflict();
  function createTable () { 
      $('#ktv_list').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         "pageLength": 10,
        "drawCallback": function( settings ) {
           $('#ktv_list_filter').after(selectedKTV);
           $('#ktv_list_selected').after(orderTour);

        } 
      });
  }
  
  createTable();

  $('#ktv_list_selected select').change(function(){
        let selected = $(this);
        var ktv = selected.val();

        let table = $('#ktv_list').DataTable();
            
        if(ktv !== "all")
        {
            table.column(2).search( ktv ).draw();//(1)
            table.on( 'search.dt', function () {//(2)
                 // console.log('Currently applied global search: '+table.search() );
               });
        }
        else
        {
            table.destroy();
            createTable ();
        }
  });

  $('#ktv_list_tour_order select').change(function(){//alert($(this).val());

        let selected = $(this);
        let loaithevip = selected.val();
        let table = $('#ktv_list').DataTable();
               
        if(loaithevip !== "all")
        {
            table.column(4).search( loaithevip ).draw();//(1)
            table.on( 'search.dt', function () {//(2)
                 // console.log('Currently applied global search: '+table.search() );
               });
        }
        else
        {
            table.destroy();
            createTable ();
        }
  });

});
</script>
              </tbody>
              </table> 
		          </div>

		          <!-- /#col-md-12 -->

<!-- ----------------------Begin Pagination  ---------------------->
    <ul class="pagination">
          <li><a href="?pageno_kh=1">First</a></li>
          <li class="<?php if($pageno_kh <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno_kh <= 1){ echo '#'; } else { echo '?pageno_kh='.($pageno_kh - 1); } ?>">Prev</a>
          </li>
<?php
  $from=$pageno_kh-3;
  $to=$pageno_kh+3;
  //
  if ($from<=0) $from=1;  $to=3*5;
  //
  if ($to>$total_pages_kh) $to=$total_pages_kh;
  for ($j=$from;$j<=$to;$j++) 
  {
    if ($j==$pageno_kh) 
    { 
?>
      <li class='active'><a href='KH_eCard.php?pageno_kh=<?=$j?>'><?=$j?></a></li>
<?php 
    } 
    else 
    { 
?>
      <li class=''><a href='KH_eCard.php?pageno_kh=<?=$j?>'><?=$j?></a></li>
<?php 
    }
  }//end for duyet paging
?>
          <li class="<?php if($pageno_kh >= $total_pages_kh){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno_kh >= $total_pages_kh){ echo '#'; } else { echo "?pageno_kh=".($pageno_kh + 1); } ?>">Next</a>
          </li>
          <li><a href="?pageno_kh=<?php echo $total_pages_kh ?>">Last</a></li>
      </ul>
<!-- ----------------------End Pagination ------------------------------------>

	         </div>
	       </div>   
	       <!-- /div class="xs" -->
  	 </div>
	   <!-- /div class="col-md-12 graphs"-->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Nav CSS -->
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" /> 

<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  	this.classList.toggle("active");
  	var dropdownContent = this.nextElementSibling;
  	if (dropdownContent.style.display === "block") {
  		dropdownContent.style.display = "none";
  	} else {
  		dropdownContent.style.display = "block";
  	}
  });
}
</script>
<script>
$('.navbar-toggle').on('click', function() {
  $('.sidebar-nav').toggleClass('block');  
});
</script>
</body>
</html>

<?php
/**
 * Note
 */
//(1): https://datatables.net/reference/api/draw()
//(2): https://datatables.net/reference/event/search