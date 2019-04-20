<label>Nhóm thiết bị</label>      
    <select id="id_nhom" name="select_paginate" style="width:100px; margin:0;" class="form-control" >                        
    <?php for ($i = 100; $i <= 400 ;) {?>
        <option value="{{$i}}" <?php if($i == $pn) echo "selected='true'"; ?> >{{$i}}</option>
    <?php $i+=100; } ?>
</select>   