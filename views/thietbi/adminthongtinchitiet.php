<?php if(isset($this->infor)){
		$thongtin = $this->infor[0];
		$action = PATH.'/thietbi/adminthongtinchitiet_submit/'.$thongtin->id;		
	}else{$action = PATH.'/thietbi/themdoituong_submit';
		}

 ?>
<div id='chitetthietbi'>
<form action="<?php echo $action; ?>" enctype="multipart/form-data" method="POST">
	<div id='chitiet_thietbi'>
		<hr>
		<?php if(isset($thongtin)){
				$src = PATH.'/media/hinhanh/'. $thongtin->hinhdaidien; 
			}else {
				$src = PATH.'/media/hinhanh/';
			}
		?>
			<img src="<?php echo $src; ?>" alt="Hinh thiet bi">			
			<div id='chi_tet'>
				<table id='bangchitet'>			
					<tr>
						<th>Tên thiết bị:</th>
						<td>
						<input type="text" name="tenthietbi" value="<?php if(isset($thongtin))echo $thongtin->tenthietbi; ?>" placeholder="">							
						</td>
					</tr>
					<tr>
						<th>Hãng sản xuất:</th>
						<td>
							<input type="text" name="hangsanxuat" value="<?php if(isset($thongtin)) echo $thongtin->hangsanxuat; ?>" placeholder="">	
						</td>
					</tr>
					<tr>
						<th>Thuộc nhóm:</th>
						<td id='td_cbonhom'>
							<!--?php echo $thongtin->tennhom;?-->
						</td>
					</tr>
					<tr>
						<th>Tình trạng:</th>
						<td id='cbo_tinhtrang'>
							<!--?php echo $thongtin->tinhtrang;?-->
						</td>						
					</tr>
					<tr>
						<th>Ngày sử dụng:</th>
						<td>
							<input type="date" name="dta_ngaysudung" value="<?php if(isset($thongtin)) echo $thongtin->tg_batdaudung;?>" placeholder="">
						</td>
					</tr>
					<tr>
						<th>Vị trí đặt:</th>
						<td>
							<input type="text" name="txt_vitridat" value="<?php if(isset($thongtin)) echo $thongtin->vitridat;?>" placeholder="">
						</td>
						
					</tr>
					<tr>
					<th>Người sử dụng:</th>
						<td id='td_nguoisudung'><!--?php if($thongtin->hoten == '')
								echo 'Thiết bị dùng chung';
							else
								echo $thongtin->hoten;?-->
						</td>
					</tr>
					<tr>
						<th>Mô tả chung:</th>
						<td>
							<textarea rows = '10'	cols = '95' id='textareastyle' name="txt_motachung"><?php if(isset($thongtin)) echo (rtrim($thongtin->motachung,''));?>
							</textarea>
						</td>
					</tr>
					<tr>
						<th>Hình đại diện</th>
						<td>
							<input name='file_hinh' type="file">
							<br>
							<input type="text" name="txt_hinhdaidien" value="<?php if(isset($thongtin)) echo $thongtin->hinhdaidien;?>" placeholder="">
						</td>
					</tr>
					
				</table>
			</div>	
	<div style="margin-top:50px;float:left">
		<input type="submit" name="submit" value="Lưu thông tin">		
	</div>
		
	</div>	
</form>
	<div id='nhatki'>
		
	</div>
	 <a href="<?php echo PATH ?>/thietbi/dsthietbi/0/<?php 
	if(isset($thongtin)) echo $this->infor[0]->nhom_id;
 ?>">Danh sach thiet bi</a>
</div>

<script>
	$(document).ready(function() {
		var urlnhomtb = "<?php echo PATH; ?>/thietbi/cbo_nhomthietbi/<?php if(isset($thongtin)) echo $thongtin->nhom_id; else echo '1'; ?>";		
		//alert(urlnhomtb);
			$.ajax({
				url: urlnhomtb,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#td_cbonhom').html(data);
				}
			});
		var urltinhtrang = "<?php echo PATH; ?>/tinhtrangthietbi/cbotinhtranghietbi/<?php if(isset($thongtin)) echo $thongtin->tinhtrang_id;else echo 1; ?>";		
			$.ajax({
				url: urltinhtrang,
				type: 'GET',
				success: function(data){					
					//var response = $.parseJSON(data);						
					$('#cbo_tinhtrang').html(data);
				}
			});
		var urlnguoidung = "<?php echo PATH; ?>/nguoidung/cbo_nguoidung/<?php if(isset($thongtin)) echo $thongtin->nguoidung_id; ?>";		
			$.ajax({
				url: urlnguoidung,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#td_nguoisudung').html(data);
				}
			});
			<?php if(isset($thongtin)) {?>
				var url = "<?php echo PATH; ?>/nhatkithietbi/xemnhatkithietbi/<?php echo $thongtin->id; ?>";		
				$.ajax({
					url: url,
					type: 'GET',
					success: function(data){						
						//var response = $.parseJSON(data);						
						$('#nhatki').html(data);
					}
				});	
			<?php } ?>
	});
</script>
