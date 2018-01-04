<?php
    $binary[500];
    $count = 0;
    $j_count=0;
    $j_cnt=0;
    $tmp_cnt=0;
     
    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $n = mb_strlen($input, "utf-8");
        for($i=0;$i<$n;$i++){
            $input_arr[$i]=mb_substr($input, $i, 1);
        }
        for($i=0;$i<$n;$i++){
            if('a'<=$input_arr[$i] && 'z'>=$input_arr[$i]){
                $num = ord($input_arr[$i])-96;
                $binary[$i] = (string)decbin($num); 
                $m = strlen($binary[$i]);
                if($m<5){
                    for($j=$j_count;$j<$j_count+(5-$m);$j++){
                        $result[$j] = '0';
                        $tmp_cnt++;
                        $j_cnt++;
                    }
                    $j_count=$tmp_cnt;
                }
                $sub_cnt=0;
                for($j=$j_count;$j<$j_count+$m;$j++){
                    $result[$j]=mb_substr($binary[$i], $sub_cnt, 1);
                    $j_cnt++;
                    $sub_cnt++;
                }
                $tmp_cnt = $j_cnt;
                $j_count=$j_cnt;
                $count++;
            }
            else{
                $result[$j_cnt] = -1;
                $binary[$i] = '-1';
                $j_cnt++;
            }
        }
        for($i=0;$i<$j_cnt;$i++){
            if($result[$i]=='1'){
                $b_result[$i] = "비빔";
            }
            else if($result[$i]=='0'){
                $b_result[$i] = "밥";
            }
            else if($result[$i]=='-1'){
                $b_result[$i] = " ";
            }
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="bibim.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
        <script>
            var count=0;
            var mov_count=0;
            var mov_ck=0;
            var mov_den=0;
            function click_count(){
                 count++;
                 if(count==10){
                     moving_bb();
                     jQuery('.icon').show();
                     count=0;
                     mov_count++;
                 }
                 if(mov_count==5){
                     mov_ck++;  
                 }
                 if(mov_ck==5){
                     mov_den=1;
                 }
            }
            function moving_bb(){
                $('.icon').animate({
                    left:1700
                },5000); 
                $('.icon').animate({
                    left:0
                },5000);
                if(mov_ck>=1){
                    jQuery('.icon_kc').show();
                    $('.icon_kc').animate({
                        top:1500
                    },5000);
                    $('.icon_kc').animate({
                        top:0
                    },5000);
                }
                if(mov_den==1){
                    jQuery('.icon_den').show();
                    $('.icon_den').animate({
                        top:1500
                    },5000);
                    $('.icon_den').animate({
                        top:0
                    },5000);
                }
            }
            function disable(){
                jQuery('.icon').hide();  
            }
        </script>
    </head>
    <body>
        <h1 class="title">Bibimbap encoder</h1>
        <form action="bibim.php" method="post">
            <input name="input" class="input"> 
            <input type="submit" class="submit" value="Encode">
        </form>
        <img src="bibim.jpg" class="image" onclick="click_count()">
        <img src="icon.png" class="icon" onclick="disable()">
        <img src="kimchi.png" class="icon_kc" onclick="disable()">
        <img src="denjang.png" class="icon_den" onclick="disable()">
        <textarea type="text" class="output" readonly>
        <?php
            for($i=0;$i<$j_cnt;$i++){
                echo $b_result[$i];
            }
        ?>
        </textarea>
    </body>
</html>