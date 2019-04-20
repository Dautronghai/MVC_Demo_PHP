<!--form action="<!?php echo PATH; ?>/nhomthietbi/themmoi" method="post" accept-charset="utf-8"-->
<?php if(isset($this->infor)){
    $tennhom = $this->infor->tennhom;
    $mota = $this->infor->mota;
    $id = $this->infor->id;
}
?>
<table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
        <tbody>
        <tr>
            <td class="nhom_web_dialog_title">Nhóm thiết bị</td>
            <td class="nhom_web_dialog_title align_right">
                <a href="javascript:void(0);" id="btnnhom_Close">Close</a>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 15px;">
                <b>Thêm/Cập nhât mới một kiểu tình trạng thiết bị? </b>
            <!--?php echo $this->query; ?-->
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 15px;">
                <div id="brands">
                    <label><b> Tên nhóm thiết bị</b>                    
                        <input id="tennhom" name="nametennhom" type="text"  placeholder ='Nhập tên nhóm' 
                        value = "<?php if(isset($tennhom)) echo $tennhom; ?>"
                        >
                    </label>
                    <br>
                    <br>
                    <br>
                    <label><b> Mô tả về nhóm</b>                                   
                        <textarea id='txt_motanhom' name="name_motanhompop"><?php if(isset($mota)) echo trim($mota,' '); ?></textarea>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input id="btnnhomSubmit" type="button" value="Lưu thay đổi">
            </td>
        </tr>
    </tbody>
</table>
<!--/form-->
<script>
    $(document).ready(function() {
        $("#btnnhom_Close").click(function (e)
        {               
            Hide_nhomDialog();
            e.preventDefault();
        });

        $("#btnnhomSubmit").click(function (e)
        {
            var themmoi = "<?php if(isset($this->infor)) echo 'false'; else echo 'true'; ?>";            
            //alert($("#txt_motanhom").val());
            if(themmoi == 'true') {
                var urlthemmoi = "<?php echo PATH; ?>/nhomthietbi/themmoi";
                alert(urlthemmoi);
                $.ajax({
                    url: urlthemmoi,
                    type: 'POST',
                    data: {
                        'nametennhom': $("#tennhom").val(),
                        'name_motanhompop': $("#txt_motanhom").val()}
                });
            }else {
                var urlcapnhat = "<?php echo PATH; ?>/nhomthietbi/capnhat";
                $.ajax({
                    url: urlcapnhat,
                    type: 'POST',
                    data: {'nametennhom': $("#tennhom").val(),
                            'name_motanhompop': $("#txt_motanhom").val(),
                            'id' : "<?php if(isset($id)) echo $id; ?>"}
                });
            };
            Hide_nhomDialog();
            // e.preventDefault();
        });
        function Hide_nhomDialog()
        {
            var urlnhomtb = "<?php echo PATH; ?>/thietbi/cbo_nhomthietbi/<?php if(isset($tennhom)) echo $id; else echo 0;?>";        
            $.ajax({
                url: urlnhomtb,
                type: 'GET',
                success: function(data){                        
                    //var response = $.parseJSON(data);                     
                    $('#td_cbonhom').html(data);
                }
            });           
            //$("#overlay").hide();
            $("#nhom_dialog").fadeOut(300);
        }    
    });            
</script>
