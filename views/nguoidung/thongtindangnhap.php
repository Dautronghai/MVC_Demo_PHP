<?php 
if(isset($this->thongtin)) ?>
<div id='thongtindangnhap'>
	<table>
		<thead>			
			<tr>
				<th colspan="2">THÔNG TIN ĐĂNG NHẬP HỆ THỐNG</th>
			</tr>
		</thead>
		<tbody>
			<tr>				
				<td>
				<div id='img'>
					<a href="<?php echo PATH; ?>/nguoidung/chitietnguoidung/<?php echo $_SESSION['user_id'] ?>">
					<img src="<?php echo PATH; ?>/media/hinhanh/<?php echo $this->thongtin->hinhdaidien; ?>" alt="hinh dai dien">
					</a>				
				</div>
				<div id='infor'>
					<p><b>Email:</b> <?php echo $this->thongtin->email; ?></p>					
					<p><b>Name: </b> <?php echo $this->thongtin->Hoten; ?></p>					
					<p><b>Role: </b><?php if($this->thongtin->vaitro == 1) echo 'Admin';else echo 'Nguoi dung' ?></p>
					<p><a href="<?php echo PATH; ?>/nguoidung/thoat">Thoat</a></p>
				</div>
					
				</td>
			</tr>			
		</tbody>
	</table>
</div>
 