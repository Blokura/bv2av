<html>
<head>
    <meta charset="utf-8" />
    <meta name="keywords" content="bv号,av号,B站,哔哩哔哩">
    <meta name="description" content="一个可以将BV号转AV号的小工具">
    <meta itemprop="name" content="BV号转AV号工具">
    <meta itemprop="description" content="一个可以将BV号转AV号的小工具">
    <meta itemprop="image" content="https://q.qlogo.cn/g?b=qq&nk=800059038&s=100">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="referrer" content="no-referrer">
    <title>BV号转AV号 - 找回视频丢失的AV号</title>
    <link href="/css/demo.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.bootcss.com/twitter-bootstrap/3.0.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/Buttons/2.0.0/css/buttons.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/5.12.1/css/fontawesome.min.css" rel="stylesheet">
	<style type="text/css">
	.bodystyle{
		margin: 0;
            padding: 0;
            width: 100%;
			height: 100%;
            font-weight: 100;
            font-family: 'Lato';
			filter:alpha(opacity=50);  
			-moz-opacity:0.5;  
			-khtml-opacity: 0.5;  
			opacity: 0.5;
			background-image:url(https://cdn.ytc233.top/ACG/api.php);background-repeat:no-repeat;
			 z-index: -1;
			position:absolute;
	}
	</style>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
			height: 100%;
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
<body>
<div class="bodystyle">
</div>
<script src="https://cdn.jsdelivr.net/gh/stevenjoezhang/live2d-widget@latest/autoload.js"></script> <!-- 加入live2d看板娘 -->
    <div class="container">
        <div class="content">
            <div class="title">BV号AV号转换</div>
        </div>
        <div class="row"></div>
            <div class="for-group">
                <div class="goo">
                    <form action="/index.php">
                    <input type="text" id="x" name="BV" placeholder="请输入视频AV/BV号(记得带上英文哦)" value="<?php echo $_GET['BV'] ?>" class="form-control" style="text-align:center"/>
                    <br>
					<br>
                    <button type="button" class = "button center button button-glow button-border button-rounded button-primary" onclick="return exchange() && false">本地JS转换</button>&nbsp;&nbsp;
					<button class = "button center button button-glow button-border button-rounded button-primary" οnclick="change()">点我换背景图</button>
					<script>
    function change() {
			document.body.style.backgroundImage="url(http://api.ytc233.top/ACG)";
    }
</script>
                    </form>
                </div>
            </div>
		<p id="result">
        <?php
		if (isset($_GET['BV'])){  
			$str = trim($_GET['BV']);  //清理空格  
			$str = strip_tags($str);   //过滤html标签  
			$str = htmlspecialchars($str);   //将字符内容转化为html实体  
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
<div class = "goog">
    <br>
    <br>
	<br>
	<p>Rebuilt by <a href="https://github.com/2594418727/bv2av" target="_blank">YTC233</a></p>
	<p>Code by <a href="https://www.zhihu.com/question/381784377/answer/1099438784" target="_blank">mcfx</a></p>
    <p>Built by <a href="https://github.com/Blokura/bv2av" target="_blank">Blokura</a></p>
	<p>JavaScript by <a href="https://mrhso.github.io/IshisashiWebsite/BVwhodoneit/" target="_blank">mrhso</a></p>
    <p>Theme by <a href="https://www.drblack-system.com" target="_blank">DrBlackの锦里</a></p>
</div>
</body>
