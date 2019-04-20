<?php if(count($this->nhatki)>0){?>
<table>
	<caption>Nhật ký thiết bị</caption>
	<thead>
		<tr>
			<th>Thời gian</th>
			<th>Thông tin hoạt động</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->nhatki as $key => $value): ?>
			<tr>
				<td><?php echo $value->thoigian; ?></td>
				<td><?php echo $value->thongtinnhatki; ?></td>
			</tr>
		<?php endforeach ?>		
	</tbody>
</table>
<?php }else{
	echo 'THiết bị này chưa có nhật ký hoạt động<br><br>';
} ?>