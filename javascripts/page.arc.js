
function __updateLoginSta(dat)
{var targetObj=document.getElementById('_userlogin');targetObj.innerHTML=dat;}
var nodedata=[];function js_viewallalist(){tobj=document.getElementById('dedepagetitles');k=0;if(tobj==undefined)return;for(i=0;i<tobj.length;i++){nodedata[k++]=[tobj.options[i].innerHTML,tobj.options[i].value];};al=document.getElementById("alist");al.innerHTML="";if(pageno=='')pageno=1;pageno=parseInt(pageno);sid=(k>3?pageno-2:0);for(i=sid;i<pageno+2;i++)
{if(nodedata[i]==undefined)continue;if(i==pageno-1)
{al.innerHTML+="<span class=\"curPage\">"+nodedata[i][0]+"</span>\n";}else
{al.innerHTML+="<a href=\""+nodedata[i][1]+"\">"+nodedata[i][0]+"</a>\n";}}
if(k>3)
{al.innerHTML+="<a href=\"#\" onclick=\"viewallalist()\">...</a>";}}
function viewallalist()
{al=document.getElementById("alist");al.innerHTML="";alHTM="";for(i=0;i<nodedata.length;i++)
{if(i==pageno-1)
{alHTM+="<span class=\"curPage\">"+nodedata[i][0]+"</span>\n";}else
{alHTM+="<a href=\""+nodedata[i][1]+"\">"+nodedata[i][0]+"</a>\n";}}
al.innerHTML=alHTM;}
function callSpecPart(cpage)
{if(cpage&&totalpage&&nodedata!=undefined&&cpage>0)
{if(cpage<totalpage&&cpage<=nodedata.length&&(top.allowSwitchPart==undefined||top.allowSwitchPart))
{window.location=nodedata[cpage-1][1];}else if(window.parent.callNextSpec!=undefined)
{window.parent.callNextSpec();}}}
function callNextPart()
{callSpecPart(pageno+1);}
function lrurl(){var htmlos=document.getElementById('bofqi').innerHTML;var stringoshtmls=htmlos.split('flashvars="');var dzurl=document.location.href;dzurl=dzurl.split('video/av');if(!dzurl[1]||stringoshtmls==undefined||stringoshtmls[1]==undefined)
{$("#link1").val("该视频无法引用!");$("#link2").val("该视频无法引用!");}
else
{stringoshtmls=stringoshtmls[1].split('"');dzurl=dzurl[1].split('/');$("#link1").val("http://static.hdslb.com/miniloader.swf?aid="+aid+"&page="+pageno);$("#link2").val('<embed height="415" width="544" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="http://static.hdslb.com/miniloader.swf" flashvars="aid='+aid+'&page='+pageno+'" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>');}}
function copy_clip(copy){if(window.clipboardData){window.clipboardData.setData("Text",copy);}
else if(window.netscape){netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');var clip=Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);if(!clip)return;var trans=Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);if(!trans)return;trans.addDataFlavor('text/unicode');var str=new Object();var len=new Object();var str=Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);var copytext=copy;str.data=copytext;trans.setTransferData("text/unicode",str,copytext.length*2);var clipid=Components.interfaces.nsIClipboard;if(!clip)return false;clip.setData(trans,null,clipid.kGlobalClipboard);}
return false;}
function showVideoInfo(obj){$(obj).find('img').attr('src',$(obj).find('img').attr('_src'));$(obj).find('img').css('top',$(obj).offset().top+18);$(obj).find('img').css('left',$(obj).position().left>630?980-350:$(obj).position().left);$(obj).find("img").css("display","block");}
function hideVideoInfo(obj){$(obj).find('img').hide();}
function showStow(aid,obj)
{if($(".stowbox:visible").length)
{$(".stowbox").slideUp(500);}else
{$.ajax({url:"/m/stow?aid="+aid,type:"GET",dataType:"html",async:true,success:function(msg){$(".stowbox").html(msg);$(".stowbox").slideDown(500);}});}
return false;}
function player_ff_resize(){$("#bofqi > embed").css("height",$(window).height());$("#bofqi > iframe").css("height",$(window).height());}
function player_ff_scroll(){$("#bofqi > embed").css("margin-top",$(window).scrollTop());}
var showlist=[];function player_ff_fullwin(status)
{if(status)
{$(".z").css("width","100%");$(".videobox").css("width","100%");$(".videobox").css("padding","0px");$(".videobox").css("margin","0px");var alldiv=$("div");for(var i=0;i<alldiv.length;i++)
{if(alldiv[i].className=="scontent"||alldiv[i].className=="videobox"||alldiv[i].className=="z")continue;if(alldiv[i].style.display!="none")
{showlist.push({item:alldiv[i],state:alldiv[i].style.display});alldiv[i].style.display="none";}}
$("#bofqi").css("height","100%");$("#bofqi").css("margin","0px");$("#bofqi").css("padding","0px");$("#bofqi").css("width","100%");$("#bofqi > iframe").css("width","100%");$("#bofqi > iframe").css("margin-top","0px");$("#bofqi > embed").css("width","100%");$("#bofqi > embed").css("padding-top","0px");$(window).resize(player_ff_resize);$(window).scroll(player_ff_scroll);player_ff_resize();player_ff_scroll();}else{$(".z").css("width","");$(".videobox").css("width","");$(".videobox").css("padding","");$(".videobox").css("margin","");for(var i=0;i<showlist.length;i++)
{showlist[i].item.style.display=showlist[i].state;}
showlist=[];$("#bofqi").css("height","");$("#bofqi").css("margin","");$("#bofqi").css("padding","");$("#bofqi").css("width","");$("#bofqi > iframe").css("width","950");$("#bofqi > iframe").css("height","484");$("#bofqi > iframe").css("margin-top","5px");$("#bofqi > embed").css("width","950px");$("#bofqi > embed").css("height","484px");$("#bofqi > embed").css("padding-top","");$("#bofqi > embed").css("margin-top","");$(window).unbind('resize',player_ff_resize);$(window).unbind('scroll',player_ff_scroll);}}
var player_bottom_visible=null;function player_fullwin(status)
{if(status)
{player_bottom_visible=false;$(".header").hide();$(".viewbox").hide();$(".upinfo").hide();$(".ad-f").hide();$(".ad").hide();$(".footer").hide();$(".large").hide();$(".small").hide();$(".s_center").hide();}else
{if(player_bottom_visible)$("#minibottom").show();$(".header").show();$(".viewbox").show();$(".upinfo").show();$(".ad-f").show();$(".ad").show();$(".footer").show();$(".large").show();$(".small").show();$(".s_center").show();}
if($.browser.mozilla)return player_ff_fullwin(status);if(status)
{$("#bofqi").removeClass("scontent");$("#bofqi").addClass("scontent_fullscreen");$("#bofqi > a").hide();$("#bofqi > iframe").css("width","100%");$("#bofqi > iframe").css("height","100%");$("#bofqi > iframe").css("margin-top","0px");$("#bofqi > embed").css("width","100%");$("#bofqi > embed").css("height","100%");$(".ad-e3").hide();$(".ad-e4").hide();$(".ad-f").hide();$(".main").css("position","static");$(".footer").hide();}else{$("#bofqi").removeClass("scontent_fullscreen");$("#bofqi").addClass("scontent");$("#bofqi > a").show();$("#bofqi > iframe").css("width","950");$("#bofqi > iframe").css("height","484");$("#bofqi > iframe").css("margin-top","5px");$("#bofqi > embed").css("width","950");$("#bofqi > embed").css("height","484");$(".main").css("position","relative");$(".ad-e3").show();$(".ad-e4").show();$(".ad-f").show();$(".footer").show();}}
function player_widewin()
{$("#bofqi > embed").css("width","950");$("#bofqi > embed").css("height","588");$("#bofqi > iframe").css("height","588");}
function loadco(){clearInterval(int_fblogin);if(typeof(AjaxPage)!="undefined")AjaxPage(1);};function flv_checkLogin()
{if(GetCookie('DedeUserID')!==undefined&&GetCookie('DedeUserID'))
{return true;}else
{return false;}}
function checkBrowser()
{if($.browser.mozilla)return;if($("#browser_tips").length)return;tips_str="<div class=\"ui-widget\" id=\"browser_tips\" style=\"margin:0px;\">"+" <div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\"> "+"   <ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" style=\"width:19px;float:right\">"+"    <li class=\"ui-state-default ui-corner-all\" style=\"cursor:pointer;\" onclick=\"$('#browser_tips').toggle( 'fold', {}, 500 );\"><span class=\"ui-icon ui-icon-closethick\"></span></li> "+"   </ul>"+"  <p id=\"browser_tips_msg\"><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;margin-top:.1em;\"></span></p>"+" </div>"+"</div>";var browser="未知";if($.browser.webkit)
{if(navigator.userAgent.match(/(chrome)[ \/]([\w.]+)/i))
{browser="Chrome";}else
{browser="WebKit";}}else if($.browser.safari)
{browser="Safari";}else if($.browser.opera)
{browser="Opera";}else if($.browser.msie)
{browser="IE";}}
var sav_kwsp=[];function createTag(tag,tcobj,_kwsp)
{var hasSP=false;if(typeof(_kwsp)!="undefined")
{sav_kwsp=_kwsp;}else
{_kwsp=sav_kwsp;}
for(var vi=0;vi<_kwsp.length;vi++)
{if(tag==_kwsp[vi])
{hasSP=true;break;}}
var sc=$("<li><a href=\"/sp/"+tag+"\" target=\"_blank\"><img src=\"http://static.hdslb.com/images/btn/btn_zhuan2.gif\" title=\"专题\" /></a><a href=\"javascript:;\">"+tag+"</a>"+(__GetCookie("bbFrontManager")||__GetCookie("DedeUserID")==mid?"<a href=\"javascript:;\"><span class=\"ui-icon del_tag ui-icon-circle-close\"></span></a>":"")+"</li>").appendTo(tcobj);if(!hasSP)
{sc.find("a:eq(0)").hide();}
sc.find("a:eq(1)").click(function(){$('.search-keyword').val(this.innerHTML);document.getElementById('searchform').submit();});sc.find("a:eq(2)").click(function(){var self=this;(new MessageBox()).show(self,'确认删除TAG?','button',function(){$.ajax("/manage/del_tag?aid="+aid+"&tag="+encodeURIComponent(tag),{success:function(data){(new MessageBox()).show(self,data=="OK"?"删除成功":data,data=="OK"?500:2000,data=="OK"?"info":"warning");if(data=="OK")$(self).parent().fadeOut(200);},error:function(){(new MessageBox()).show(self,"删除失败，请检查您的网络",2000,"error");}});});});}
function kwtags(_kwlist,_kwsp)
{kwlist=_kwlist;var chNode=$('embed');var fvar;for(var i=0;i<chNode.length;i++){if(chNode[i]&&(fvar=$(chNode[i]).attr('flashvars'))&&fvar.indexOf("file=")!=-1)
{checkBrowser();break;}}
if(typeof(kwlist)=="undefined")return;var tcobj=".s_tag .tag";for(i=0;i<kwlist.length;i++)
{if(kwlist[i].match(/^([sn]m|av)[0-9]+$/))
{$("<li><a href=\"http://acg.tv/"+kwlist[i]+"\" target=\"_blank\" class=\"tag\">"+kwlist[i]+"</a></li>").appendTo(tcobj);}else
{createTag(kwlist[i],tcobj,_kwsp);}}
if($('iframe[src^="https://secure.bilibili.tv"]').size()>0)
{if(window.postMessage){var onMessage=function(e){if(e.origin=="https://secure.bilibili.tv"&&e.data.substr(0,6)=="secJS:")
{eval(e.data.substr(6));}
if(typeof(console.log)!="undefined")
{console.log(e.origin+": "+e.data);}};if(window.addEventListener){window.addEventListener("message",onMessage,false);}else if(window.attachEvent){window.attachEvent("onmessage",onMessage);}}else
{setInterval(function(){if(evalCode=__GetCookie('__secureJS'))
{__SetCookie('__secureJS','');eval(evalCode);}},1000);}}}
function addNewTag(aid)
{len=0;document.getElementById("newtag").innerHTML="<input type=\"text\" value=\"\" id=\"newtag_in\" size=\"20\" /> <input type=\"submit\" class=\"button\" value=\"新增\" onclick=\"submitNewTag(this,"+aid+")\" />";var ac={source:function(request,response){$.getJSON("/m/suggest?jsoncallback=?",{term:request.term.replace(/　/g,""),rnd:Math.random()},response);},search:function(){var term=this.value;if(term.charCodeAt(0)<255&&term.length<2||term.length>10){return false;}},focus:function(){return false;},select:function(event,ui){this.value=ui.item.value;return false;}};$("#newtag_in").attr("autocomplete","off");$("#newtag_in").autocomplete(ac).data("autocomplete")._renderItem=function(ul,item){return $("<li></li>").data("item.autocomplete",item).append("<a style=\"text-align:left\">"+item.value+"<em style=\"float:right;font-size:10px;\""+(item.match?" title=\"(Match Token: "+item.match+")\"":"")+">"+(item.desc?item.desc:item.ref+"个")+"</em></a>").appendTo(ul);};return false;}
function submitNewTag(obj,aid)
{msgbox=new MessageBox();var kt=$("#newtag_in").val();$.ajax("/m/v_addtag?aid="+aid+"&newtag_in="+encodeURIComponent(kt),{success:function(data){if(data=="OK"){$("#newtag_in").val("");createTag(kt,".s_tag .tag");}
msgbox.show(obj,data=='OK'?'添加成功!':data,data=='OK'?500:2000,data=='OK'?'ok':'warning');},error:function(){msgbox.show(obj,'系统错误，请稍后重试!',2000,'error');}});}
var autofresh_interval=null;function init_autofresh(aid,mid)
{var refresh_func=function()
{var scrObj=document.createElement("script");scrObj.src="/plus/count.php?papa=yes&reload="+Math.random()+"&aid="+aid+"&mid="+mid;scrObj.type="text/javascript";scrObj.language="javascript";document.body.appendChild(scrObj);};autofresh_interval=setInterval(refresh_func,30000);}
function heimu(api,b)
{var heimu=document.getElementById("heimu");if(b==0)
{document.getElementById("heimu").style.display="none";}
else
{document.getElementById("heimu").style.opacity="."+api/10;document.getElementById("heimu").style.filter="alpha(opacity="+api+")";document.getElementById("heimu").style.display="block";document.getElementById("heimu").style.position="fixed";}}
function shareTo163(info,url,img)
{var url='link=http://www.bilibili.tv/&source='+encodeURIComponent('哔哩哔哩弹幕视频网')
+'&info='+encodeURIComponent(info)+' '+encodeURIComponent(url)
+'&images='+img+'&togImg=true';window.open('http://t.163.com/article/user/checkLogin.do?'+url+'&'+new Date().getTime(),'newwindow','height=330,width=550,top='+(screen.height-280)/2+',left='+(screen.width-550)/2+', toolbar=no, menubar=no, scrollbars=no,resizable=yes,location=no, status=no');return false;}
function SinaWeibo(info,url,img)
{var _w=72,_h=16;var param={url:url,type:'3',count:'1',appkey:'1727689474',title:info,pic:img,ralateUid:'',language:'zh_cn',rnd:new Date().valueOf()}
var temp=[];for(var p in param){temp.push(p+'='+encodeURIComponent(param[p]||''))}
$('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?'+temp.join('&')+'" width="'+_w+'" height="'+_h+'"></iframe>').appendTo("#weibo_sina");}
function shareToQQ(info,url,img){var _u='http://v.t.qq.com/share/share.php?title='+encodeURIComponent(info)+'&url='+url+'&appkey=84435a83a11c484881aba8548c6e7340&site=http://www.bilibili.tv/&assname=bilibiliweb&pic='+img;window.open(_u,'','width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');return false;}
function shareToSohu(info,url,img)
{var url='http://t.sohu.com/third/post.jsp?url='+url+'&title='+encodeURIComponent(info)+'&content=utf-8&pic='+img;window.open(url,'','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=450');return false;}
function loadrating(param)
{$.ajax("/plus/comment.php?"+param,{success:function(data){data=data.replace(/\/plus\/comment\.php\?([^']+)/ig,'javascript:loadrating("$1")');$("#arc_r_box").html(data);$rat=$('.ratin li');$rat.click(function(){var index=$rat.index($(this));if(index==0)
{$('.w_c_n').show();}
else
{$('.w_c_n').hide();}
$rat.removeClass();$($rat.get(index)).addClass('on');$('#rating').val($($rat.get(index)).attr('v'));});$('#ratconfirm').click(function()
{var msg="";switch(parseInt($('#rating').val()))
{case 5:case 10:case 20:msg=($('#rating').val()*parseInt($('#multiply').val()))+'积分';break;case 100:msg=$('#multiply').val()+'硬币';}
return msg?confirm('此次操作将消耗您 '+msg+' 。请确认是否继续？'):true;});}});}
function flashChecker(){var hasFlash=false;var flashVersion=0;var isIE=0;if(isIE){try{var swf=new ActiveXObject('ShockwaveFlash.ShockwaveFlash');if(swf){hasFlash=true;VSwf=swf.GetVariable("$version");flashVersion=parseInt(VSwf.split(" ")[1].split(",")[0]);}}
catch(e){}}else{if(navigator.plugins&&navigator.plugins.length>0)
{var swf=navigator.plugins["Shockwave Flash"];if(swf)
{hasFlash=true;var words=swf.description.split(" ");for(var i=0;i<words.length;++i)
{if(isNaN(parseInt(words[i])))continue;flashVersion=parseInt(words[i]);}}}}
return{hasFlash:hasFlash,flashVersion:flashVersion};}
function loadHTML5(aid,page)
{var isiOS=navigator.userAgent.match(/iPad/i)!=null||navigator.userAgent.match(/iPhone/i)!=null||navigator.userAgent.match(/iPod/i)!=null;var isAndroid=navigator.userAgent.match(/Android/i)!=null;var hasFlash=flashChecker();if(hasFlash.hasFlash||(!isiOS&&!isAndroid))return;$.getJSON("/m/html5?aid="+aid+"&page="+page,function(data){if(typeof(data.src)=="undefined")return;$("#bofqi").html('<link type="text/css" href="http://static.hdslb.com/css/video-js.min.css" rel="stylesheet" /><link type="text/css" href="http://static.hdslb.com/css/bilibili-js.min.css" rel="stylesheet" /><video id="movie" class="video-js vjs-default-skin bilibili-skin" data-setup="{}" autoplay="autoplay" width="600" height="450" preload="auto" controls="controls"><source src="'+data.src+'" type="video/mp4" />  </video><div id="mukioControls" class="vjs-control mukio-control"><div id="stylePanel" class="style-panel"></div><input type="button" id="styleSelector" class="button style-selector" /><input type="text" id="textInput" class="text-input" size="35" /><input type="button" id="sentCmt" class="button send-button" value="发送评论"/><input type="button" id="showHideCmt" class="button show-hide-button" value="隐藏"/><div class="spacer"></div></div><input type="hidden" id="cid" value="'+data.cid+'" /><script type="text/javascript" src="http://static.hdslb.com/js/bilibili.packed.js"></scr'+'ipt>');});}
function bindRIAttent()
{$(".r-info > .f").click(function(){attentionUser(this,$(this).attr("mid"));$(".r-info > .f").html("<a>已关注</a>");$(".r-info > .f").addClass("on");$(".r-info > .f").unbind("click");bindRIUnattent();});}
function bindRIUnattent()
{$(".r-info > .f").click(function(){unattentionUser(this,$(this).attr("mid"));$(".r-info > .f").html("<a>关注他</a>");$(".r-info > .f").removeClass("on");$(".r-info > .f").unbind("click");bindRIAttent();});}
function tracksendLog(url,tp)
{$("<script type=\"text/javascript\" src=\"https://secure.bilibili.tv/tracklog?url="+encodeURIComponent(url)+"&tp="+encodeURIComponent(tp)+"&refer="+encodeURIComponent(document.referrer)+"\"></script>").appendTo("body");}
var trackTime;var adCheckInt=null;var isCProTrackSent=false;function trackCProLog(){tracksendLog(document.location,"b");isCProTrackSent=true;}
function trackCProTimeOver(){trackTime=new Date();clearTimeout(adCheckInt);if(!isCProTrackSent)adCheckInt=setTimeout(function(){clearTimeout(adCheckInt);trackCProLog();},3000);}
var _ads_bindCount=0;function bindAdElement(){var e=document.getElementsByTagName("iframe");for(var i=0;i<e.length;i++){if(e[i].src.indexOf('www.bilibili.tv/bd')>-1&&__GetCookie('DedeUserID')){e[i].onmousedown=trackCProLog;e[i].onmouseover=trackCProTimeOver;e[i].onactivate=trackCProLog;e[i].onclick=trackCProLog;e[i].onfocusin=e[i].onfocus=trackCProLog;e[i].contentWindow.onactivate=e[i].contentWindow.onfocusin=e[i].contentWindow.onfocus=trackCProLog;_ads_bindCount++;}}
var e=document.getElementsByTagName("div");for(var i=0;i<e.length;i++){if(e[i].id=='comm_content'||e[i].className=="viewbox"||e[i].className=="upinfo"||e[i].className=="ad-f"||e[i].className=="bottom"||e[i].className=="tagcontainer"||e[i].className=="scontent")
{e[i].onmouseover=function(){if(adCheckInt==null||new Date().getTime()-trackTime.getTime()<50)return;clearTimeout(adCheckInt);adCheckInt=null;};}}
$("body").mouseover(function(){if(adCheckInt==null||new Date().getTime()-trackTime.getTime()<50)return;clearTimeout(adCheckInt);adCheckInt=null;});}
function getBasicHighCharts(opts,render)
{opts.chart.renderTo=render;opts.subtitle={text:document.ontouchstart===undefined?'Click and drag in the plot area to zoom in':'Drag your finger over the plot to zoom in'};return opts;}
$(function(){var mid=$(".r-info > .f").attr("mid");var follow_him=false;if(typeof(window.AttentionList)!="undefined"&&typeof(window.AttentionList)!="null")
{for(var i=0;i<window.AttentionList.length;i++)
{if(window.AttentionList[i]==mid)
{follow_him=true;break;}}}
if(follow_him)
{$(".r-info > .f").html("<a>已关注</a>");$(".r-info > .f").addClass("on");bindRIUnattent();}else
{$(".r-info > .f").html("<a>关注他</a>");bindRIAttent();}
if(__GetCookie("bbFrontManager"))
{$("<script type=\"text/javascript\" src=\"http://static.hdslb.com/js/highcharts.js\"></script>").appendTo("head");$("<a href=\"javascript:;\">&nbsp;&nbsp;查看日志</a>").appendTo("#newtag").click(function(){var self=this;function insertLayer()
{$("<div style=\"width: 690px;padding: 5px;background: #fff0c9;float: left;display:none\" id=\"tag_log\"><img src=\"http://static.hdslb.com/images/loading/loading2.gif\"> <b>Loading...</b></div>").insertAfter(self.parentNode.parentNode);$("#tag_log").slideDown(200);$.getJSON("/manage/log_tag?aid="+aid,function(data)
{$('#tag_log').animate({backgroundColor:"#c9f0ff"},500);$("#tag_log").empty();if(data.code!=0)
{$("#tag_log").html("错误: "+data.message);}else
{var tbl=$('<table cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#EFEFEF"><td>时间</td><td>IP</td><td>帐号</td><td>暱名</td><td>操作</td><td>Tag</td></tr></table>').appendTo("#tag_log");for(var i=0;i<data.data.length;i++)
{var dt=data.data[i];$('<tr bgcolor="#FFFFFF"><td>'+dt.date+'</td><td>'+dt.ip+'</td><td><a href="//space.bilibili.tv/'+dt.mid+'" target="_blank">'+dt.userid+'</a></td><td><a href="//space.bilibili.tv/'+dt.mid+'" target="_blank">'+dt.uname+'</a></td><td>'+(dt.operate=="ADD"?"<b style=\"color:green\">添加</b>":"<b style=\"color:red\">删除</b>")+'</td><td'+(!dt.isvalid?" style=\"background:#ffefef\"":"")+'>'+dt.tag+'</td></tr>').appendTo(tbl);}}
$("<div style=\"padding: 15px;background-color:#fff\"><a href=\"http://interface.bilibili.tv/admin_panel?aid="+aid+"\" target=\"_blank\">进入稿件管理</a> <a href=\"http://member.bilibili.tv/#video&act=history&aid="+aid+"\" target=\"_blank\">投稿修改日志</a></div><br />").prependTo("#tag_log");var chart;$.getJSON("/manage/daily_stat?aid="+aid,function(data)
{$("<br /><br /><div id=\"imgContent\"></div><br /><br /><div id=\"imgContent2\"></div>").appendTo("#tag_log");var chart_options=getBasicHighCharts(data.data,'imgContent');chart=new Highcharts.Chart(chart_options);if(data.subdata!==false)
{var chart_options=getBasicHighCharts(data.subdata,'imgContent2');chart=new Highcharts.Chart(chart_options);}});});}
if($("#tag_log").length==0)
{insertLayer();}else
{$("#tag_log").slideUp(200,function(){$(this).remove();insertLayer();});}});}});