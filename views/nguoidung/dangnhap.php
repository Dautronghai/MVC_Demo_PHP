<?php 
//session_start(); 
	if(isset($_SESSION['user_id'])){?>
		<script>		
			window.location.href = "<?php echo PATH ?>/nguoidung/taikhoandangnhap/<?php echo $_SESSION['user_id']; ?>/";
		</script>
	<?php }else	{
	?>	
		<div id='form_login'>
				<form method="POST" action="<?php echo PATH; ?>/nguoidung/dangnhap">		
					<fieldset>
					<legend>Đăng nhập</legend>
						<?php if(isset($this->error)) echo '<p style="color:RED;">'.$this->error.'</p>';
		 				?>
						<table> 
							<tr>								
								<td>
									<p>Username</p>
									<input type="text" name="email" placeholder="Email dang nhap" value="trannguyen@gmail.com">							
								</td>
							</tr>
							<tr>
								
								<input type='password' style = 'display:none' />
								<td>
									<p>Password</p>
									<input type="password" name="password" value="1234@1234" placeholder="Mat khau" >	
								</td>
							</tr>
							<tr>
								<td align="center"> <input type="submit" value="Đăng nhập"></td>
							</tr>
						</table>
					</fieldset>
				</form>
		</div>
<?php } ?>