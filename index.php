<html>
<head>
    <meta charset="utf-8" />
    <meta name="keywords" content="bv号,av号,B站,哔哩哔哩">
    <meta name="description" content="一个可以将BV号转AV号的小工具">
	<meta itemprop="name" content="BV号转AV号工具">
	<meta itemprop="description" content="一个可以将BV号转AV号的小工具">
	<meta itemprop="image" content="https://q.qlogo.cn/g?b=qq&nk=800059038&s=100">
	<meta name="referrer" content="no-referrer">
    <title>BV号转AV号 - 找回视频丢失的AV号</title>
    <link href="/css/demo.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/twitter-bootstrap/3.0.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/Buttons/2.0.0/css/buttons.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/5.12.1/css/fontawesome.min.css" rel="stylesheet">
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a64cd95a180806066a7d13a0b531b6d1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
	</script>
    <style>
        html,
        body {
            height: 100%;
        }
        
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }
        
        .container {
            text-align: center;
            display: block;
            position: relative;
            top: 150px;
            vertical-align: middle;
        }
        
        .content {
            text-align: center;
            display: inline-block;
        }
        
        .title {
            font-size: 66px;
        }
        
        .title small {
            font-size: 33px;
        }
        
        .title a {
            color: #000;
            text-decoration: none;
        }
        
        goo {
            display: block;
            position: fixed;
            top: 250px;
        }
        goog{
            display: block;
            position: fixed;
            bottom:0px;
        }
    </style>
</head>
<body background="/images/background.png">
    <div class="container">
        <div class="content">
            <div class="title">BV号⇆AV号</div>
        </div>
        <div class="row"></div>
            <div class="for-group">
                <div class="goo">
                    <form action="/index.php">
                    <input type="text" id="x" name="BV" placeholder="请输入视频AV/BV号" value="<?php echo $_GET['BV'] ?>" class="form-control" style="text-align:center"/>
                    <br>
					<br>
                    <button type="button" class = "button center button button-glow button-border button-rounded button-primary" onclick="return exchange() && false">本地JS转换</button>&nbsp;&nbsp;
					<button type="submit" class = "button center button button-glow button-border button-rounded button-primary" >获取视频信息</button>
                    </form>
                </div>
            </div>
		<p id="result">
        <?php
		if (isset($_GET['BV'])){  
			$str = trim($_GET['BV']);  //清理空格  
			$str = strip_tags($str);   //过滤html标签  
			$str = htmlspecialchars($str);   //将字符内容转化为html实体  
			$str = addslashes($str);  //防止SQL注入
		}  
		if($str != ""){
			$bv = stristr($str,"BV1");
			$bv = substr($bv,0,12);
			if(strlen($str) != 12){
				if(strtolower(substr($str,0,2)) == 'av'){
					echo dec($str);
				}elseif(strlen($str) == 9){
					echo dec('BV1'.$str);
				}elseif(strlen($str) == 10){
					echo dec('BV'.$str);
				}else{
					echo "<font size='4' color='red'>".$str." ¿你在想桃子?</font>";
				}
			}else{
				echo dec($bv);
			}
		}
		?>
		</p>
<script>
'use strict';

const table = [...'fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF'];
const s = [11, 10, 3, 8, 4, 6];
const xor = 177451812;
const add = 8728348608;

const av2bv = (av) => {
    let num = NaN;
    if (Object.prototype.toString.call(av) === '[object Number]') {
        num = av;
    } else if (Object.prototype.toString.call(av) === '[object String]') {
        num = parseInt(av.replace(/[^0-9]/gu, ''));
    };
    if (isNaN(num) || num <= 0) {
        // 网页版直接输出这个结果了
        return '¿你在想桃子?';
    };

    num = (num ^ xor) + add;
    let result = [...'bv1  4 1 7  '];
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
        return '¿你在想桃子?';
    };
    if (!str.match(/[Bb][Vv][fZodR9XQDSUm21yCkr6zBqiveYah8bt4xsWpHnJE7jL5VG3guMTKNPAwcF]{10}/gu)) {
        return '¿你在想桃子?';
    };

    let result = 0;
    let i = 0;
    while (i < 6) {
        result += table.indexOf(str[s[i]]) * 58 ** i;
        i += 1;
    };
    return `av${result - add ^ xor}`;
};


const exchange = () => {
	var x = document.getElementById('x').value;
	if(x.substring(0,2).toLowerCase()=='bv'){
        document.getElementById('x').value = `${bv2av(x)}`;
	}else if(x.substring(0,2).toLowerCase()=='av'){
        document.getElementById('x').value = `${av2bv(x)}`;
	}
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
	if($numbe <=0 )return "<font size='5' color='red'>".$numbe." </font>";
	$ch = curl_init();
	if(strtolower(substr($x,0,2))=='av'){
		curl_setopt($ch, CURLOPT_URL, 'https://api.bilibili.com/x/web-interface/view/detail?aid='.substr($x,2));
	}else{
		curl_setopt($ch, CURLOPT_URL, 'https://api.bilibili.com/x/web-interface/view/detail?bvid='.$x);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$output = curl_exec($ch);
	$json = json_decode($output);
	curl_close($ch);
	if(is_numeric($json->data->View->aid)){
		if(strtolower(substr($x,0,2))=='av'){
			return $x."<br>↓↓↓↓↓↓</br><font size='6' color='red'>".$json->data->View->bvid."</font><br/><br/><a href='https://www.bilibili.com/video/av".$json->data->View->aid."' target='_blank'><img src='".str_replace("http://","https://",$json->data->View->pic)."' width='192' height='118'></a><br/>".$json->data->View->title."<br/>UP主:<a href='https://space.bilibili.com/".$json->data->View->owner->mid."' target='_blank'>".$json->data->View->owner->name."</a>";
		}else{
			return $x."<br>↓↓↓↓↓↓</br><font size='6' color='red'>av".$json->data->View->aid."</font><br/><br/><a href='https://www.bilibili.com/video/av".$json->data->View->aid."' target='_blank'><img src='".str_replace("http://","https://",$json->data->View->pic)."' width='192' height='118'></a><br/>".$json->data->View->title."<br/>UP主:<a href='https://space.bilibili.com/".$json->data->View->owner->mid."' target='_blank'>".$json->data->View->owner->name."</a>";
		}
	}else{
		return $x.'<br/>↓↓↓↓↓↓</br><br><font size="5" font color="red">av'.$numbe.'<br><br><a target="_blank" class="button button-3d button-primary button-rounded" href=https://www.bilibili.com/video/av'.$numbe.">点击跳转</a></b></font>";
	}
}
?>
<div class = "goog">
    <br>
    <br>
    <br>
	<p>Code by <a href="https://www.zhihu.com/question/381784377/answer/1099438784" target="_blank">mcfx</a></p>
    <p>Built by <a href="https://github.com/Blokura/bv2av" target="_blank">Blokura</a></p>
	<p>JavaScript by <a href="https://mrhso.github.io/IshisashiWebsite/BVwhodoneit/" target="_blank">mrhso</a></p>
    <p>Theme by <a href="https://www.drblack-system.com" target="_blank">DrBlackの锦里</a></p>
</div>