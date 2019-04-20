<div id='danhsachthietbi'>
	<table>
			<h3> DANH SÁCH THIẾT BỊ CỦA CÔNG TY</h3>
			<?php $thietbi = new Controller_thietbi();
				echo $thietbi->dsNhomthietbi();
			 ?>
			 <button style="margin-left:20px; height:30px;" id='themmoidoituong' type="button" text='Thêm mới'>Thêm mới</button>
			<hr>
			<thead>
				<tr>
					<th>TÊN TB</th>
					<th>HÃNG SX</th>
					<th>MÔ TẢ CHUNG</th>					
					<th>NƠI ĐẶT</th>
				</tr>				
			</thead>			
			<tbody>			
				<?php 
					$list = $this->result;
					foreach ($list as $value) {?>
						<tr class='<?php echo $value->id; ?>'>
							<td style="width:10%;"><?php echo $value->tenthietbi; ?></td>
							<td style="width:13%;"><?php echo $value->hangsanxuat; ?></td>
							<td style="width:63%;"><?php echo $value->motachung; ?></td>
							<td><?php echo $value->vitridat; ?></td>
						</tr>						
				<?php }
				?>				
			</tbody>
		</table>
		<ul id='phantrang'>
			<?php for($i=0;$i<$this->tongsotrang;$i++){ 
				if($this->search ==='%') {
					$string = PATH .'/thietbi/dsthietbi/'. $i.'/';
				}else {
					$string = PATH .'/thietbi/dsthietbi/'. $i.'/'.$this->search;
				}
			?>
			<li id="<?php echo $i; ?>">
				<a><?php echo $i+1; ?>
				</a>
			</li>
			<?php }?>
		</ul>
	<script>
	$(document).ready(function() {
		$('#phantrang li:eq(<?php echo $this->trangso; ?>)').css('background-color', '#272822');
		$('#phantrang li:eq(<?php echo $this->trangso; ?>) a').css('color', 'white');
		$('#id_nhomtb option[value="<?php echo $this->search; ?>"]').attr('selected', 'selected');
	});
	$(document).ready(function() {
		$('#id_nhomtb').on('change',function() {
			var idnhom = $('#id_nhomtb').val();
			//window.location.href = "<?php echo PATH; ?>/thietbi/dsthietbi/0/"+idnhom;
			var url = "<?php echo PATH; ?>/thietbi/dsthietbiajax/0/"+idnhom;
			$.ajax({
				url: url,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#danhsachthietbi').html(data);
				}
			});			
		});
		$('#phantrang li').on('click', function() {
			var idnhom = $('#id_nhomtb').val();
			var trangso = $(this).attr('id');
			var url = "<?php echo PATH; ?>/thietbi/dsthietbiajax/" + trangso + "/"+idnhom;
			$.ajax({
				url: url,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#danhsachthietbi').html(data);
				}
			});	
		});
		$('#danhsachthietbi table tbody tr').on('click', function() {
			var id = $(this).attr('class');			
			window.location.href='<?php echo PATH; ?>/thietbi/thongtinchitiettb/'+id;
		});
		$('#themmoidoituong').on('click', function() {
			//var id = $(this).attr('class');			
			window.location.href='<?php echo PATH; ?>/thietbi/Themmoidoituong';
		});

	});
	</script>
</div>