<html>
<head>
	<title>BV号转AV号工具 - 找回视频丢失的AV号</title>
	<meta name="Keywords" Content="BV号,AV号,B站,哔哩哔哩">
	<meta name="Description" Content="一个可以将BV号转AV号的小工具">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="referrer" content="no-referrer">
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a64cd95a180806066a7d13a0b531b6d1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
	<center>
		<font size="5"><b>找回哔哩哔哩视频丢失的AV号</b></font><br><br>
		<input type="text" id="av" placeholder="AV..."><button onclick="return av() && false">AV 号转 BV 号</button><br>
		<input type="text" id="bv" placeholder="BV..."><button onclick="return bv() && false">BV 号转 AV 号</button><br>
		
		<?php
		if (isset($_GET['BV'])){  
			$str = trim($_GET['BV']);  //清理空格  
			$str = strip_tags($str);   //过滤html标签  
			$str = htmlspecialchars($str);   //将字符内容转化为html实体  
			$str = addslashes($str);  //防止SQL注入
		}else{
			echo "<p id='x'></p>↓<br><font id='result' size='4' color='red'></font><br/>";
		}
		if($str != ""){
			$bv = stristr($str,"BV1");
			$bv = substr($bv,0,12);
			if(strlen($str) != 12){
				if(strlen($str) == 9){
					echo dec('BV1'.$str);
				}elseif(strlen($str) == 10){
					echo dec('BV'.$str);
				}else{
					echo "<font size='4' color='red'>".$str."查询的不是一个正确的BV号</font>";
				}
			}else{
				echo dec($bv);
			}
			echo "<br/><br/><font color='grey' size='2'><a href='https://github.com/Blokura/bv2av' target='_blank'>github</a></font><br><font size='1' color='grey'>已支持www.bilibili.bv2av.com/video/BV1XJ41157tQ方式查询<br>(在B站链接中加入bv2av就可以查询啦)</font>";
		}else{
			echo "<font color='grey' size='2'>本地解密转换</font> <a href='https://www.zhihu.com/question/381784377/answer/1099438784' target='_blank'>算法</a> <a href='https://mrhso.github.io/IshisashiWebsite/BVwhodoneit/' target='_blank'>鸣谢</a><br><br/><font size='1' color='grey'>支持https://www.bilibili.bv2av.com/video/BV1XJ41157tQ方式查询(在链接中加入bv2av就可以查询啦)</font><br/><b>强烈谴责某些小人DDOS和举报危险域名<br>本网站不含任何广告以及违法内容，也没有任何信息收集，请自便</b><br/><br/><font size='4'><b>更多功能</b></font><br>查询用户信息和粉丝勋章：<a href='http://nbtester.com/breeze/user.t' target='_blank'>nbtester</a><br>查询用户直播中奖记录：<a href='https://www.madliar.com/bili/raffles' target='_blank'>madliar</a><br><br><font color='grey' size='2'><a href='https://github.com/Blokura/bv2av' target='_blank'>github</a></font>";
		}
		?>
	</center>
<script>
// 改写自 https://www.zhihu.com/question/381784377/answer/1099438784，并加上一些适当的处理
// JS抄自 https://mrhso.github.io/IshisashiWebsite/BVwhodoneit/ 非常感谢
'use strict';

const table = [...'fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF'];
const s = [11, 10, 3, 8, 4, 6, 2, 9, 5, 7];
const xor = 177451812;
const add = 100618342136696320;

const av2bv = (av) => {
    let num = NaN;
    if (Object.prototype.toString.call(av) === '[object Number]') {
        num = av;
    } else if (Object.prototype.toString.call(av) === '[object String]') {
        num = parseInt(av.replace(/[^0-9]/gu, ''));
    };
    if (isNaN(num) || num <= 0) {
        // 网页版直接输出这个结果了
        return '¿你在想桃子？';
    };

    num = (num ^ xor) + add;
    let result = [...'BV '];
    let i = 0;
    while (i < 6) {
        // 这里改写差点犯了运算符优先级的坑
        // 果然 Python 也不是特别熟练
        // 说起来 ** 按照传统语法应该写成 Math.pow()，但是我个人更喜欢 ** 一些
        result[s[i]] = table[Math.floor(num / 58 ** i) % 58];
        i += 1;
    };
    return result.join('');
};

const bv2av = (bv) => {
    let str = '';
    if (bv.length === 12) {
        str = bv;
    } else if (bv.length === 10) {
        str = `BV${bv}`;
    // 根据官方 API，BV 号开头的 BV1 其实可以省略
    // 不过单独省略个 B 又不行（
    } else if (bv.length === 9) {
        str = `BV1${bv}`;
    } else {
        return '¿你在想桃子？';
    };
    if (!str.match(/[Bb][Vv][fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF]{10}/gu)) {
        return '¿你在想桃子？';
    };

    let result = 0;
    let i = 0;
    while (i < 6) {
        result += table.indexOf(str[s[i]]) * 58 ** i;
        i += 1;
    };
    return `av${result - add ^ xor}`;
};

const av = () => {
	document.getElementById('x').innerText = `${document.getElementById('av').value}`;
    document.getElementById('result').innerText = `${av2bv(document.getElementById('av').value)}`;
};

const bv = () => {
	document.getElementById('x').innerText = `${document.getElementById('bv').value}`;
    document.getElementById('result').innerText = `${bv2av(document.getElementById('bv').value)}`;
};
</script>
</body>

<?php
function dec($x){
	$table = 'fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF';
	$tr = array();
	for ($i=0;$i<58;$i++) {
		$tr[$table[$i]]=$i;
	}
	$s = array(11,10,3,8,4,6,2,9,5,7);
	$xor=177451812;
	$add=100618342136696320;
	//
	$r = 0;
	for ($i=0;$i<10;$i++) {
		$r += $tr[$x[$s[$i]]]*pow(58,$i);
	}
	$numbe = $r-$add^$xor;
	if($numbe <=0 )return "<font size='4' color='red'>".$numbe."查询的不是一个正确的BV号</font>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.bilibili.com/x/web-interface/view/detail?bvid='.$x);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$output = curl_exec($ch);
	$json = json_decode($output);
	curl_close($ch);
	if(is_numeric($json->data->View->aid)){
		return "<p id='x'>".$x."</p>↓<br><font id='result' size='4' color='red'>av".$numbe."</font><br/><br/><a href='https://www.bilibili.com/video/av".$json->data->View->aid."' target='_blank'><img src='".str_replace("http://","https://",$json->data->View->pic)."' width='192' height='108'></a><br/>".$json->data->View->title."<br/>UP主:<a href='https://space.bilibili.com/".$json->data->View->owner->mid."' target='_blank'>".$json->data->View->owner->name."";
	}else{
		return $x.'<br/>↓<br><font color="red"><b>av'.$numbe."</b></font>";
	}
}
?>