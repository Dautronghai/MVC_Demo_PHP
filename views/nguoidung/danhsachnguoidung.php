<div id='DanhsachNguoidung'>
	<table id='tabledsnguoidung'>
		<label><input id='tukhoatimkiem'type="text" name="timkiem" value="" placeholder="họ tên người dùng"><input id='btn_search' type="button" name="" value="Tìm kiếm">
		</label>
		 <button style="margin-left:20px; height:30px;" id='themmoinguoidung' type="button" text='Thêm mới'>Thêm mới</button>
		<hr>			
		<thead>
			<tr>
				<th>Email</th>
				<th>Họ tên</th>										
			</tr>				
		</thead>			
		<tbody>			
			<?php 
				$list = $this->result;					
				foreach ($list as $value) {?>
					<tr class='<?php echo $value->id; ?>'>
						<td style="width:10%;"><?php echo $value->email; ?></td>
						<td style="width:13%;"><?php echo $value->Hoten; ?></td>		
					</tr>						
			<?php }
			?>				
		</tbody>
	</table>
		<ul id='phantrang'>
			<?php for($i=0;$i<$this->tongsotrang;$i++){ 
				if($this->search ==='%') {
					$string = PATH .'/nguoidung/dsnguoidung/'. $i.'/';
				}else {
					$string = PATH .'/nguoidung/dsnguoidung/'. $i.'/'.$this->search;
				}
			?>
			<li id="<?php echo $i; ?>">
				<a><?php echo $i+1; ?>
				</a>
			</li>
			<?php }?>
		</ul>
<div id="nguoidung_dialog" class='nguoidung_web_dialog' >
   
</div>
<script>
	$(document).ready(function() {
		$('#themmoinguoidung').click(function() {
			var urlnguoidung = '<?php echo PATH ?>/nguoidung/viewthemnguoidung';
                //alert(url);
			$.ajax({ 
					url: urlnguoidung,
					type: 'GET',					
					success: function(data){						
						//var response = $.parseJSON(data);						
						$('#nguoidung_dialog').html(data);
					}
			});	
            ShownguoidungDialog(true);
            e.preventDefault();
		});
	});
	function ShownguoidungDialog(modal)
        {            
            $("#nguoidung_dialog").fadeIn(300);
        }
</script>
<script>
	$(document).ready(function() {
		$('#phantrang li:eq(<?php echo $this->trangso; ?>)').css('background-color', '#272822');
		$('#phantrang li:eq(<?php echo $this->trangso; ?>) a').css('color', 'white');
		// $('#id_nhomtb option[value="<?php echo $this->search; ?>"]').attr('selected', 'selected');
	});
	$(document).ready(function() {
		$('#btn_search').on('click',function() {
			var idnhom = $('#tukhoatimkiem').val();
			//window.location.href = "<?php echo PATH; ?>/thietbi/dsthietbi/0/"+idnhom;
			var url = "<?php echo PATH; ?>/nguoidung/dsnguoidungjax/0/"+idnhom;
			$.ajax({
				url: url,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#DanhsachNguoidung').html(data);
				}
			});			
		});
		$('#tukhoatimkiem').keypress(function(e) {
			if(e.which === 13){
				$('#btn_search').click();
			}
		});

		$('#phantrang li').on('click', function() {
			var idnhom = $('#tukhoatimkiem').val();
			var trangso = $(this).attr('id');
			var url = "<?php echo PATH; ?>/nguoidung/dsnguoidungjax/" + trangso + "/"+idnhom;
			$.ajax({
				url: url,
				type: 'GET',
				success: function(data){						
					//var response = $.parseJSON(data);						
					$('#DanhsachNguoidung').html(data);
				}
			});	
		});
		$('#DanhsachNguoidung table tbody tr').on('click', function() {
			var id = $(this).attr('class');			
			window.location.href='<?php echo PATH; ?>/nguoidung/chitietnguoidung/'+id;
		});
		$('#themmoinguoidung').on('click', function() {
			//var id = $(this).attr('class');			
			//window.location.href='<?php echo PATH; ?>/nguoidung/chitietnguoidung';
		});
	});
	</script>
</div>