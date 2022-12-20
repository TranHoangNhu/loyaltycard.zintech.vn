<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');

@session_start();
$kh = new clsKhachHang($conn);
date_default_timezone_set('Asia/Bangkok');

if(!isset($_SESSION['TenSD'])) 
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

$timkiem = 0; $themmoi = 0; $chinhsua = 0; $xoa = 0; $stt = "";
$tenkh = ""; $diachi = ""; $email = ""; $didong = ""; $maloaithe = ""; $tinhtrangid = "";
$tongtien = 0;

if(@$_GET['chinhsua'] != null)
{
    $chinhsua = @$_GET['chinhsua'];
}
if(@$_GET['themmoi'] != null)
{
    $themmoi = @$_GET['themmoi'];
}
if(@$_GET['xoa'] != null)
{
    $xoa = @$_GET['xoa'];
}
//
if(@$_GET['stt'] != null)
{
    $stt = @$_GET['stt'];
  
    $l_sql="select * from tblWeb_KhachHangDangKyMemberCard Where Stt like '$stt'";
    try
    {
        $rs=$conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
        if($rs !== false)
        {
            foreach($rs as $r)
            {
                $r['TenKH']; $r['DiDong']; $r['DiaChi']; $r['Email']; 
                $r['TinhTrangID']; $r['MaLoaiThe']; $r['TongTien'];

                $tenkh = $r['TenKH']; $email = $r['Email'];
                $didong = $r['DiDong']; $diachi = $r['DiaChi'];
                $tinhtrangid = $r['TinhTrangID']; $maloaithe = $r['MaLoaiThe'];
                $tongtien = intval($r['TongTien']);
            }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
//
if($xoa == 1 && $stt != "")
{
    $sql = "Delete from tblWeb_KhachHangDangKyMemberCard Where Stt like '$stt'";
    $rs=$conn->query($sql);
    $xoa = 0;
}

if($themmoi == 1)
{
    $stt = "";
}
//
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
    }
    //
    if(isset($_GET['filter_phone']))
    {
        $filter_phone = $_GET['filter_phone'];
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

<div id="ktv_list_selected">
    <div class="form-group" >
        <div class="col-sm-6 col-md-2">
        </div>
    </div>
</div>
<div id="ktv_list_tour_order">
    <div class="form-group">
        <div class="col-sm-6 col-md-2">
            <select  class="form-control">
                <option selected="true" disabled="disabled">Loại thẻ</option>
                <option value = 'all'>Tất cả </option>
<?php
    $loaithe_list = $kh->getDMLoaiTheVip();
    if($loaithe_list != false)
    {
          foreach($loaithe_list as $r)
          {
?>
              <option value="<?=$r['MaLoaiThe']?>"><?=$r['TenLoaiThe']?></option>
<?php
          }
    }
?>
           </select>
        </div>
    </div>
</div>

<!--                                  The Modal 1 : thong tin khach hang                        -->
<div id="myModal" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>KÍCH HOẠT MEMBER CARD</h3>
        <form action="KH_register_update.php" method="post" >
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
                <div class="col-sm-3">Loại thẻ : </div>
                <div class="col-sm-9">
                    <select name="loaithe">
<?php
    if($loaithe_list != false)
    {
          foreach($loaithe_list as $r)
          {
?>
              <option value="<?=$r['MaLoaiThe']?>" <?php if($r['MaLoaiThe'] == $maloaithe) echo "selected" ?>><?=$r['TenLoaiThe']?></option>
<?php
          }
    }
?>                        
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">Tình trạng : </div>
                <div class="col-sm-9">
                    <select name="tinhtrang">
                        <option value="0" selected>Chưa kích hoạt</option>
                        <option value="1">Kích hoạt thẻ</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="btn" name="btn_update" value="Cập nhật">
            </div>  
        </form>
    </div>
</div>

<?php
if($chinhsua == 1 || $themmoi == 1)  // co thong tin nhập típ
{
    $chinhsua = 0; $themmoi = 0;
?>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        modal.style.display = "block";

        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
        }
    </script>
    <!--                          END THE MODAL 1                         -->
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

  $total_pages_sql = "select COUNT(*) as SoKH from tblWeb_KhachHangDangKyMemberCard";
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

  $totalKH = 0;
$kh_list = $kh->getRegisterList($filter_kh, $filter_phone, $startRow, $endpoint, $totalKH);

$kh_arr = array();

foreach($kh_list as $r)
{
  $kh_arr[] = [
        'Stt' => $r['Stt'], 
        'TenKH' => $r['TenKH'], 
        'DiDong' => $r['DiDong'], 
        'Email' => $r['Email'], 
        'DiaChi' => $r['DiaChi'],
        'MaLoaiThe' => $r['MaLoaiThe'], 
        'TenLoaiThe' => $r['TenLoaiThe'], 
        'TinhTrangID' => $r['TinhTrangID'],
        'TongTien' => $r['TongTien']
    ];
}

$stttemp = "";
//$kh_list =  customizeArrayKH_Register( $kh_arr );

?>

<div class="row">
    <form action="KH_register.php" method="GET">
        <div class="col-md-4">
                    Name <input type="text" value="<?=$filter_kh?>" id="filter_kh" name="filter_kh" style="width:60%;" />
        </div>
        <div class="col-md-4">
                    Phone <input type="text" value="<?=$filter_phone?>" id="filter_phone" name="filter_phone" style="width:60%;"/>
        </div>
                    
            <div class="col-md-4">
                        <button type="submit" class="btn" style="background-color: green;color:white;margin-left: 70px;font-style: bold;font-weight: 100px;width: 100px;" name ="timkiem" value="1">Tìm</button>
                        <button type="submit" class="btn" style="background-color: green;color:white;margin-left: 10px;font-style: bold;font-weight: 100px" name ="themmoi" value="1">Thêm Mới
                        </button>
            </div>
    </form>
</div>

<div class="row">
    <?php
    echo "   So Luong: ".sizeof($kh_arr)."/".$total_rows; 
    ?>
</div>
	         <div class="row">
		          <div class="col-md-12">
                <table class="table">
                <thead>
                  <tr>
                    <th>Tên</th>    
                    <th>Điện thoại</th>
                    <th>Email</th>    
                    <th>Địa chỉ</th>    
                    <th>Thời gian</th>
                    <th>Loai Thẻ</th>
                    <th>Kích hoạt thẻ</th>             
                  </tr>
            </thead>
            <tbody>
<?php 

foreach( $kh_list as $k )
{
    $stttemp = $k['Stt'];//->Stt;
?>
          <tr class="success">
              <td><?php echo $k['TenKH'];?></td>
              <td><?php echo $k['DiDong'];?></td>      
              <td><?php echo $k['Email'];?></td>     
              <td><?php echo $k['DiaChi'];?></td>
              <td><?php echo $k['ThoiGianDangKy'];?></td>
              <td><?php echo $k['TenLoaiThe'];?></td>
              <td><a href="KH_register.php?stt=<?php echo $k['Stt']; ?>&chinhsua=1">Kích hoạt</a></td>
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
      <li class='active'><a href='KH_register.php?pageno_kh=<?=$j?>'><?=$j?></a></li>
<?php 
    } 
    else 
    { 
?>
      <li class=''><a href='KH_register.php?pageno_kh=<?=$j?>'><?=$j?></a></li>
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