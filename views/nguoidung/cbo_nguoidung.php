<select id="cbo_nguoidung" name="cbo_nguoidungthietbi" class="form-control" >
	<option value="null">Thiết bị dùng chung</option>
<?php foreach ($this->nguoidung as $key => $value): ?>
	<option value="<?php echo $value->id; ?>" <?php if($value->id === $this->selected[0]) 
			echo 'selected'; ?> 
		>		
		<?php echo $value->Hoten; ?>
	</option>
<?php endforeach ?>
</select>
<input id='btnthem_nguoidung' type="button" name="" value="Add">

<div id="nguoidung_dialog" class='nguoidung_web_dialog' >
   
</div>
<script>
	$(document).ready(function() {
		$('#btnthem_nguoidung').click(function() {
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
