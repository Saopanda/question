<?php
/* 一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去…，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。*/

/**
 * 参考正确解法
 */
function mytest($n,$m)
{
	
	//	思路 
	//	组成一个圈一直数
	//	数的次数是 $m倍数时就删掉
	//	不符合倍数就删掉放数组末尾供它再数
	//	这里次数和数组键名相关联
	//	$i 次数
	$i= 0;

	//	构建数组
	$arr = range(1, $n);

	//	数组循环到只剩一个元素
	while (count($arr) > 1) {
		$ci = $i+1;
		if($ci%$m == 0){	// $m倍数 剔除
			unset($arr[$i]);
		}else{
			//	不符合倍数的放数组最后, 闭合成圈
			array_push($arr,$arr[$i]);
			unset($arr[$i]);
		}
		$i++;
	}
	return $arr[$i];
}

echo mytest(111,222);


/**
 * 解题失败
 */
function counts($n,$m){
	//	思路
	//	一圈一圈减
	//	分俩种情况
	//	1. 一圈够减1次以上
	//	把m倍数的符合的都减去, 计算余几 第二次减作为一个偏移值
	//	把数组重新排列
	//	2. 一圈不够减1次
	//	取余 看看要减哪个数, 减完记录偏移值
	//	把数组重新排列
	//	
	//	然后就GG了 有些值对有些不对 不知道哪里错误了


	//	构建数组
	$arr = range(1,$n);

	while (count($arr) > 1) { //当数组只剩一个值 停止
		$lengths = count($arr);
		if(count($arr) >= $m){//如果单圈还能再减一次
			//	每次循环的长度 
			//	上一次如果有余数 要把余数加到这一次的循环长度中
			//	因为截至上一圈减完, 是从上圈的余数开始继续数
			//	所以本圈长度要加上上圈的余数
			$lengths += $yu;
			//	1. 计算本圈能一共能减几次
			$num = intval(($lengths)/$m);
			//	循环一次次减
			for ($i=0; $i < $num; $i++) { 
				//	$aa * $m - $yu 第 $aa 次减本圈的第几个元素
				unset($arr[($i+1)*$m-$yu-1]);
			}
			//	给减完的数组排列新建名
			$arr = array_values($arr);
			//	本圈减完, 剩下几个
			$yu = $lengths%$m;
		}else{//	单圈不能再减一次了
			// 每一圈都比 $M 小
			//	循环完后 停留在的位置
			//	$m + 上次余数 / 长度 余几减去第几个数
			$di = ($m+$yu)%$lengths;
			if($di == 0){//如果没有余数 就减去最后一个
				$di = $lengths;
			}
			unset($arr[$di-1]);
			//	重新排列键名
			$arr = array_values($arr);
			//	减完当圈剩几个
			$yu = $lengths - $di;
		}
	}
	return $arr[0];
}
?>

