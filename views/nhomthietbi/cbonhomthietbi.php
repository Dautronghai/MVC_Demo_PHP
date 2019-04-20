<select id="cbo_nhomtb" name="cbo_nhomtb" class="form-control" >
	<?php foreach ($this->dsnhom as $key => $value): ?>
		<option <?php if($value->id === $this->idchecked) 
				echo 'selected'; ?> 
			value="<?php echo $value->id; ?>">
			<?php echo $value->tennhom; ?>
		</option>
	<?php endforeach ?>
</select>
<input id='btnadd_nhom' type="button" name="" value="Add">
<input id='btnedit_nhom' type="button" name="" value="Edit">

<div id="nhom_dialog" class='nhom_web_dialog' >
   
</div>
<script type="text/javascript">

        $(document).ready(function ()
        {
            $("#btnadd_nhom").click(function (e)
            {
            	var url = '<?php echo PATH ?>/nhomthietbi/viewthemnhom';
                //alert(url);
				$.ajax({ 
						url: url,
						type: 'GET',						
						success: function(data){						
							//var response = $.parseJSON(data);						
							$('#nhom_dialog').html(data);
						}
				});	
                ShowNhomDialog(true);
                e.preventDefault();
            });
            $("#btnedit_nhom").click(function (e)
            {
            	var select = $('#cbo_nhomtb option:selected').val();
            	var url2 = '<?php echo PATH ?>/nhomthietbi/viewcapnhatnhom';
				$.ajax({ 
						url: url2,
						type: 'POST',
						data: {'nhom_id': select},
						success: function(data){																		
							$('#nhom_dialog').html(data);
						}
				});	
                ShowNhomDialog(true);
                e.preventDefault();
            });
        });

        function ShowNhomDialog(modal)
        {            
            $("#nhom_dialog").fadeIn(300);
        }
</script>