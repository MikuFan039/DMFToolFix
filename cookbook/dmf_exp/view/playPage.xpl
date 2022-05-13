<!--
需要变量
LOCALVERSION
$TAGS => tag
$SOURCE : string
messages => $MessageFmt
IsMuti
-->
<!-- BEGIN: main -->
<table border='0' width='100%' cellpadding='3' cellspacing='0' >
    <tr>
        <td  valign='top'>
            <div  style='color: black; background-color: #f7f7f7; border: 1px solid #cccccc; padding: 4px;' >
                <!-- BEGIN: source -->
                <p>来源：{SOURCE}</p>
                <!-- END: source -->
                <!-- BEGIN: tagListEditable -->
                <form action='{GROUP}' method='post'>
                    <input type='hidden' name='action' value='xestagpages' />
                    Tags:&nbsp;&nbsp;{TAGS}<input type='text' name='Tags' class='inputbox' size='6' /><input type='submit' value='追加Tag' class='inputbutton' />
                </form>
                <!-- END: tagListEditable -->
                <!-- BEGIN: tagListNormal -->
                <p>Tags:&nbsp;&nbsp;{TAGS}</p>
                <!-- END: tagListNormal -->
                <!-- BEGIN: messages -->
                <p>{MESSAGES}</p>
                <!-- END: messages -->
            </div>
        </td>
        <td rowspan='3' bgcolor='#f7f7f7' width='950'  valign='top'>
            <!-- BEGIN: PartContainer -->
            <div  style='font-size: small;' > 
                <p><strong>分P:</strong><br />
                <!-- BEGIN: PARTDATA -->
                {PARTTEXT}
                <!-- END: PARTDATA -->
             </p></div>
            <!-- END: PartContainer -->
            <p><strong>备注:</strong></p>
            <!-- BEGIN: DESC -->
            {DESCTEXT}
            <!-- END: DESC -->
        </td>
    </tr>
    <tr>
        <td width='950'  valign='top'>
            <hr />
            <!-- BEGIN: DanmakuBar -->
            <!-- BEGIN: Upload -->
            <form action='/poolop/post/{GROUP}/{DANMAKUID}' class='DanmakuBar' enctype='multipart/form-data' method='post'>
                <input name='uploadfile' type='file' />弹幕池:<select class='inputbox' name='Pool'>
                    <option value='Static'>静态</option>
                    <option value='Dynamic' selected="selected">动态</option>
                </select>追加:<input name='Append' type='checkbox' value='true' checked="checked"/><input class='inputbutton' name='post' type='submit' value='上传' />
            </form>&nbsp;&nbsp;
            <!-- END: Upload -->
            <!-- BEGIN: Download -->
            <form action='/poolop/loadxml/{GROUP}/{DANMAKUID}' class='DanmakuBar' method='get'>
                下载格式：
                <select class='inputbox' name='format'>
                    <!-- BEGIN: Format -->
                    <option value='{FORMAT}'>{FORMAT}</option>
                    <!-- END: Format -->
                </select>
                分割：
                <select class='inputbox' name='split'>
                    <option value='0'>无限</option>
                    <option value='199'>199 </option>
                    <option value='500'>500 </option>
                    <option value='1000'>1000</option>
                </select>
                附件：<input checked='checked' name='attach' type='checkbox' value='true' />
                <input class='inputbutton' type='submit' value='下载' />
            </form>&nbsp;&nbsp;
            <!-- END: Download -->
            <!-- BEGIN: Refresh--> <span class='DanmakuBar'> <a style='color: black' href="javascript:refreshPlayer();">刷新</a> </span><!-- END: Refresh-->
            <!-- BEGIN: NewLine--> <br /> <!-- END: NewLine-->
            <!-- BEGIN: DynamicPool -->
            <span style='color: black; background-color: #f7f7f7; border: 1px solid #cccccc; padding: 4px; line-height: 2em;'>
                <a class='urllink' href='/poolop/validate/{GROUP}/{DANMAKUID}/dynamic' style='color: black'>验证动态池</a>&nbsp;&nbsp;
                <a class='wikilink' href='/DMR/{SUID}{DANMAKUID}?action=edit' style='color: black'>动态池编辑</a>&nbsp;&nbsp;
            </span>
            <!-- END: DynamicPool -->
            <!-- BEGIN: PageOperation -->
            <span style='color: black; background-color: #f7f7f7; border: 1px solid #cccccc; padding: 4px; line-height: 2em;'>
                <a class='wikilink' href='?action=edit' style='color: black'>编辑Part</a>&nbsp;&nbsp;
            </span>
            <!-- END: PageOperation -->
            <!-- BEGIN: PoolOperation -->
            <span style='color: black; background-color: #f7f7f7; border: 1px solid #cccccc; padding: 4px; line-height: 2em;'>
                清空弹幕池： 
                    <a class='urllink' href='/poolop/clear/{GROUP}/{DANMAKUID}/static' style='color: black'>静态</a>&nbsp;
                    <a class='urllink' href='/poolop/clear/{GROUP}/{DANMAKUID}/dynamic' style='color: black'>动态</a>&nbsp;
                    <a class='urllink' href='/poolop/clear/{GROUP}/{DANMAKUID}/all' style='color: black'>双杀</a>&nbsp;&nbsp;&nbsp;
                合并弹幕池： 
                    <a class='urllink' href='/poolop/merge/{GROUP}/{DANMAKUID}/static/dynamic' style='color: black'>S-&gt;D</a>&nbsp;
                    <a class='urllink' href='/poolop/merge/{GROUP}/{DANMAKUID}/dynamic/static' style='color: black'>D-&gt;S</a>&nbsp;
                弹幕id随机化：
                    <a class='urllink' href='/poolop/randomize/{GROUP}/{DANMAKUID}/static' style='color: black'>静态</a>&nbsp;
                    <a class='urllink' href='/poolop/randomize/{GROUP}/{DANMAKUID}/dynamic' style='color: black'>动态</a>&nbsp;
                    <a class='urllink' href='/poolop/randomize/{GROUP}/{DANMAKUID}/all' style='color: black'>双开</a>&nbsp;&nbsp;&nbsp;
            </span>
            <!-- END: PoolOperation -->
            <!-- END: DanmakuBar -->
            
            <div id="flashcontainer">
                <div id='flashcontent'> </div>
            </div>
            <script type="text/javascript">
                function loadPlayer() {
                    var flashvars = {};
                    var params = {};
                    <!-- BEGIN: FlashVars -->{FLASHVARS.Name} = {FLASHVARS.Value};
                    <!-- END: FlashVars -->
                    <!-- BEGIN: PlayerLoader -->
                    
                    swfobject.embedSWF("{URL}", "flashcontent", "{WIDTH}", "{HEIGHT}", "10.0.0","expressInstall.swf", flashvars, params);
                    <!-- END: PlayerLoader -->
                }
                
                function refreshPlayer() {
                    swfobject.removeSWF("flashcontent");
                    var d = document.createElement("div");
                    d.setAttribute("id", "flashcontent");
                    document.getElementById("flashcontainer").appendChild(d);
                    loadPlayer();
                }
                
                loadPlayer();
            </script>
            
        </td>
    </tr>
    <tr>
        <td width='950'  valign='top'>
            <hr />
            <p>切换播放器：&nbsp;&nbsp;
                <!-- BEGIN: PlayerLoaderCurrent -->
                <strong>{NAME}</strong>&nbsp;&nbsp;
                <!-- END: PlayerLoaderCurrent -->
                <!-- BEGIN: PlayerLoaderAdmin -->
                <a class='urllink' href='{PLAYER.URL}'>{PLAYER.Name}</a><a class='urllink' href='{PLAYER.SetDefaultUrl}'></a>&nbsp;&nbsp;
                <!-- END: PlayerLoaderAdmin -->
                <!-- BEGIN: PlayerLoaderNormal -->
                <a class='urllink' href='{PLAYER.URL}'>{PLAYER.Name}</a>&nbsp;&nbsp;
                <!-- END: PlayerLoaderNormal -->
            </p>
        <br/><p>提示：如果你的页面不显示播放器，请阅读并按照<a href="/Main/FAQ" title="疑难解答">疑难解答</a>中的要求正确配置浏览器和Flash Player。</p>
        </td>
    </tr>
</table>
<!-- END: main -->