<!--form action="<!?php echo PATH; ?>/nhomthietbi/themmoi" method="post" accept-charset="utf-8"-->
<table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
        <tbody>
        <tr>
            <td class="nguoidung_web_dialog_title">Người dùng thiết bị</td>
            <td class="nguoidung_web_dialog_title align_right">
                <a href="javascript:void(0);" id="btnnguoidung_Close">Close</a>
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
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 15px;">
                <div id="brands">
                    <label><b> Email:</b>                    
                        <input id="txt_email" name="nametxt_email" type="text"  placeholder ='Nhập email người dùng' 
                        >
                    </label>                    
                </div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>            
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input id="btnnguoidungSubmit" type="button" value="Lưu thay đổi">
            </td>
        </tr>
    </tbody>
</table>
<!--/form-->
<script>
    $(document).ready(function() {
        $("#btnnguoidung_Close").click(function (e)
        {               
            Hide_nguoidungDialog();
            e.preventDefault();
        });

        $("#btnnguoidungSubmit").click(function (e)
        {
            var urlthemmoi = "<?php echo PATH; ?>/nguoidung/themmoi";
            //alert(urlthemmoi);
            $.ajax({
                url: urlthemmoi,
                type: 'POST',
                data: {
                    'nametxt_email': $("#txt_email").val(),
                }
            });            
            Hide_nguoidungDialog();
            // e.preventDefault();
        });
        function Hide_nguoidungDialog()
        {
            var urlnguoidungtb = "<?php echo PATH; ?>/nguoidung/cbo_nguoidung/0";        
            $.ajax({
                url: urlnguoidungtb,
                type: 'GET',
                success: function(data){                        
                    //var response = $.parseJSON(data);                     
                    $('#td_nguoisudung').html(data);
                }
            });
            var urldsnguoidungtb = "<?php echo PATH; ?>/nguoidung/dsnguoidungjax";        
            $.ajax({
                url: urldsnguoidungtb,
                type: 'GET',
                success: function(data){                        
                    //var response = $.parseJSON(data);                     
                    $('#DanhsachNguoidung').html(data);
                }
            });         
            //$("#overlay").hide();
            $("#nguoidung_dialog").fadeOut(300);
        }    
    });            
</script>
