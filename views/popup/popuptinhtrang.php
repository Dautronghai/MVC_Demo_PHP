<!--form action="/tinhtrangthietbi/themmoi" method="post" accept-charset="utf-8"-->
<?php if(isset($this->infor)){
    $tinhtrang = $this->infor->tinhtrang;
    $id = $this->infor->id;
}
?>
<table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
        <tbody>
        <tr>
            <td class="web_dialog_title">Tình trạng thiết bị!</td>
            <td class="web_dialog_title align_right">
                <a href="javascript:void(0);" id="btnClose">Close</a>
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
                    <label><b> Tên tình trạng</b>                    
                        <input id="tentinhtrang" name="tentinhtrang" type="text"  placeholder ='Nhập kiểu tình trạng thiết bị' 
                        value = "<?php if(isset($tinhtrang)) echo $tinhtrang; ?>"
                        >
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
                <input id="btnSubmit" type="button" value="Lưu thay đổi">                
            </td>
        </tr>
    </tbody>
</table>
<!--/form-->
<script>
    $(document).ready(function() {
        $("#btnClose").click(function (e)
        {               
            HideDialog();
            e.preventDefault();
        });

        $("#btnSubmit").click(function (e)
        {
            var themmoi = "<?php if(isset($this->infor)) echo 'false'; else echo 'true'; ?>";
            //alert(themmoi);
            if(themmoi == 'true') {
                var url = "<?php echo PATH; ?>/tinhtrangthietbi/themmoi";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'tentinhtrang': $("#tentinhtrang").val()}
                });
            }else {
                var urlcapnhat = "<?php echo PATH; ?>/tinhtrangthietbi/capnhat";
                $.ajax({
                    url: urlcapnhat,
                    type: 'POST',
                    data: {'tentinhtrang': $("#tentinhtrang").val(),
                            'id_tinhtrang': "<?php if(isset($id)) echo $id; ?>"}
                });
            };
            HideDialog();
            // e.preventDefault();
        });
        function HideDialog()
        {
            var urltinhtrang = "<?php echo PATH; ?>/tinhtrangthietbi/cbotinhtranghietbi/<?php if(isset($tinhtrang)) echo $id; else echo 0;?>";
            $.ajax({
                url: urltinhtrang,
                type: 'GET',
                success: function(data){                    
                    //var response = $.parseJSON(data);                     
                    $('#cbo_tinhtrang').html(data);
                }
            });
            //$("#overlay").hide();
            $("#dialog").fadeOut(300);
        }    
    });            
</script>
