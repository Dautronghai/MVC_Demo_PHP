<?php $thongtin = $this->thongtin; ?>
<form action="<?php echo PATH; ?>/nguoidung/luuthongtin/" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
	<div id='chitietnguoidung'>
		<div id='header'>
			<h3>Thông tin chi tiết người dùng</h3>
		</div>
		<div id='bodythongtin'>
			<input type="hidden" name="id" value="<?php echo $thongtin->id; ?>">
			<img src="<?php echo PATH; ?>/media/hinhanh/<?php echo $thongtin->hinhdaidien; ?>" alt="Chân dung">
			<table id='tbl_thongtinc'>	
				<tr>
					<th>Họ tên</th>
					<td>
						<input type="text" name="hoten" value="<?php echo $thongtin->Hoten; ?>">
					</td>
				</tr>
				<tr>
					<th>Ngày sinh</th>
					<td>
						<input type="date" name="ngaysinh" value="<?php echo $thongtin->ngaysinh; ?>">
					</td>
				</tr>			
				<tr>
					<th>Giới tính</th>
					<td>
						<label><input value="1" type="radio" id='nam' name="gioitinh" <?php if((int)$thongtin->gioitinh > 0)echo 'checked'; ?>>Nam</label>
						<label><input value="-1" type="radio" id='nu' name="gioitinh"<?php if((int)$thongtin->gioitinh < 0)echo 'checked'; ?>>Nữ</label>	
					</td>
				</tr>
				<tr>
					<th>Địa chỉ</th>
					<td>
						<input type="text" name="diachi" value="<?php echo $thongtin->diachi; ?>">
					</td>
				</tr>
				<?php if ($_SESSION['user_vaitro']>0): ?>
					<tr>
						<th>Chức vụ</th>
						<td>
							<input type="text" name="chucvu" value="<?php echo $thongtin->chucvu; ?>">
						</td>				
					</tr>
				<?php endif ?>			
				
				<tr>
					<th>Email</th>
					<td>
						<input type="text" name="email" value="<?php echo $thongtin->email; ?>">
					</td>
				</tr>
				<tr>
					<th>Số điện thoại</th>
					<td>
						<input type="text" name="sdt" value="<?php echo $thongtin->sodienthoai; ?>">
					</td>
				</tr>
				<?php if ($_SESSION['user_vaitro']>0): ?>
					<tr>
						<th>Vai trò</th>
						<td>
							<label>
								<input value="1" type="radio" id='admin' name="ravaitro" <?php if((int)$thongtin->vaitro > 0)echo 'checked'; ?>
							>Admin</label>
							<label>
							<input value="-1" type="radio" id='nguoidung' name="ravaitro" <?php if((int)$thongtin->vaitro < 0)echo 'checked'; ?>>Người dùng</label>	
						</td>
					</tr>
				<?php endif ?>	
				<tr>
					<th>Hình đại diện</th>
					<td>
						<input name='file_hinh' type="file">
						<br>
						<input type="text" name="hinhdaidien" value="<?php if(isset($thongtin)) echo $thongtin->hinhdaidien;?>" placeholder="link hình">
					</td>
				</tr>
			</table>
			<div style="margin-top:50px;float:left">
			<input type="submit" name="submit" value="Lưu thông tin">		
		</div>
		</div>
	</div>
</form>