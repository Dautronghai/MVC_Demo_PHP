<table id='id_bangnhatki'>	
	<thead>
		<tr>
			<th>Thời gian</th>
			<th>Thông tin hoạt động</th>
		</tr>
	</thead>
	<tbody>
	<?php if(count($this->nhatki)>0){?>
		<?php foreach ($this->nhatki as $key => $value): ?>
			<tr>
				<td><?php echo $value->thoigian; ?></td>
				<td><?php echo $value->thongtinnhatki; ?></td>
			</tr>
		<?php endforeach ?>		
	<?php }else{
		echo '<tr><td></td>'.
			'<td>Chưa có thong tin</td>'.
			'</tr>';
	} ?>
	</tbody>

</table>
