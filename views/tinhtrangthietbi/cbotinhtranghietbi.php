
<select id="cbo_tinhtrangthietbi" name="cbo_tinhtrangthietbi" class="form-control" >
	<?php foreach ($this->tinhtrang as $key => $value): ?>
		<option <?php if($value->id === $this->selected) 
				echo 'selected'; ?> 
			value="<?php echo $value->id; ?>">
			<?php echo $value->tinhtrang; ?>
		</option>
	<?php endforeach ?>
</select>

<input id='btnShowModal' type="button" name="" value="Add">
<input id='btneditShowModal' type="button" name="" value="Edit">

<div id="dialog" class="web_dialog">

   
</div>
<script>
	$(document).ready(function() {
		
	});
</script>
<script type="text/javascript">

        $(document).ready(function ()
        {
            $("#btnShowModal").click(function (e)
            {
            	var url = '<?php echo PATH ?>/tinhtrangthietbi/viewthemtinhtrang';
				$.ajax({ 
						url: url,
						type: 'GET',						
						success: function(data){						
							//var response = $.parseJSON(data);						
							$('#dialog').html(data);
						}
				});	
                ShowDialog(true);
                e.preventDefault();
            });
            $("#btneditShowModal").click(function (e)
            {
            	var select = $('#cbo_tinhtrangthietbi option:selected').val();
            	var url = '<?php echo PATH ?>/tinhtrangthietbi/viewCapnhattinhtrang';
				$.ajax({ 
						url: url,
						type: 'POST',
						data: {'tinhtrang_id': select},
						success: function(data){						
							//var response = $.parseJSON(data);						
							$('#dialog').html(data);
						}
				});	
                ShowDialog(true);
                e.preventDefault();
            });
        });

        function ShowDialog(modal)
        {
            //$("#overlay").show();
            $("#dialog").fadeIn(300);

            // if (modal)
            // {
            //     //$("#overlay").unbind("click");
            // }
            // else
            // {
            //     // $("#overlay").click(function (e)
            //     // {
            //     //     HideDialog();
            //     // });
            // }
        }

        // function HideDialog()
        // {
        //     $("#overlay").hide();
        //     $("#dialog").fadeOut(300);
        // } 
        
</script>
