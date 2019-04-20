<?php 
	$thongtin = $this->infor[0];
 ?>
<div id='chitetthietbi'>
	<div id='chitiet_thietbi'>
		<hr>
			<img src="<?php echo $thongtin->hinhdaidien; ?>" alt="Hinh thiet bi">
			<div id='chi_tet'>
				<table id='bangchitet'>			
					<tr>
						<th>Tên thiết bị:</th>
						<td><?php echo $thongtin->tenthietbi; ?></td>
					</tr>
					<tr>
						<th>Hãng sản xuất:</th>
						<td><?php echo $thongtin->hangsanxuat; ?></td>
					</tr>
					<tr>
						<th>Thuộc nhóm:</th>
						<td><?php echo $thongtin->tennhom;?></td>
					</tr>
					<tr>
						<th>Tình trạng:</th>
						<td><?php echo $thongtin->tinhtrang;?></td>
					</tr>
					<tr>
						<th>Ngày sử dụng:</th>
						<td><?php echo $thongtin->tg_batdaudung;?></td>
					</tr>
					<tr>
						<th>Vị trí đặt:</th>
						<td><?php echo $thongtin->vitridat;?></td>
					</tr>
					<tr>
						<th>Người sử dụng:</th>
						<td><?php if($thongtin->hoten == '')
								echo 'Thiết bị dùng chung';
							else
								echo $thongtin->hoten;?>
						</td>
					</tr>
					<tr>
						<th>Mô tả chung:</th>
						<td><?php echo $thongtin->motachung;?></td>
					</tr>
				</table>
			</div>	
	</div>
	<div id='nhatki'>
		
	</div>
	 <a href="<?php echo PATH ?>/thietbi/dsthietbi/0/<?php 
	echo $this->infor[0]->nhom_id;
 ?>">Danh sach thiet bi</a>
</div>
<script>
	$(document).ready(function() {
		var url = "<?php echo PATH; ?>/nhatkithietbi/xemnhatkithietbi/<?php echo $thongtin->id; ?>";		
			$.ajax({
				url: url,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#nhatki').html(data);
				}
			});	
	});
</script>