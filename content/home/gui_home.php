<script src="js/slidePanel.js" ></script>
<script src="js/inputFieldValidator.js" ></script>
<script src="js/colorPicker.js" ></script>
<script lang="javascript" type="text/javascript">
    var fieldValidator = new InputFieldValidator('fieldValidator');
</script>
<div class="MainContent">
    <div>
    <?php
        echo "<table class=\"colorTable\">";
            $ColorArray = array(
            '00','CC','33','66','99','FF'
        );
        $i = 0;
        echo "<tr>";
        for($j=0; $j<6; $j++){
            for($a=0; $a<6; $a++){
                for($b=0; $b<6; $b++){
                    $v = $ColorArray[$j].$ColorArray[$a].$ColorArray[$b];
                    echo "<td onclick=\"colorPicker.getColor('_".$v."');\" id=\"_".$v."\" bgcolor='#".$v."'></td>";
                    $i++;        
                    if($i%25==0) {
                        echo "</tr><tr>";
                    }
                }
             }
        }
        echo "</tr>";
        echo "</table>";
?>
        <input type="text" id="hexadecimal" value="" onclick="colorPicker.setTargetField('hexadecimal');" />    
    </div></br>
    <div>
        <form method="POST" action="index.php?pointer=home">
            <input id="ints" type="text" value="" name="ints" onchange="fieldValidator.validateLength(5, 'ints', 'Not proper length', 0);" />
            <div id="ints_errorbox"></div>
        <input type="submit" value="test" />
        </form>
    </div>
    </br>
    <div id="prom_slidePanel" class="prom_slidePanel">
        <div class="prom_slide" id="prom_slidePanel_slide0">            
            <img class="prom_slide_image" id="prom_slidePanel_slide_image0"  src="" alt="" style="" />
        </div>
        <div class="prom_slide" id="prom_slidePanel_slide1">            
            <img class="prom_slide_image" id="prom_slidePanel_slide_image1" src="" alt="" style="" />            
        </div>        
        <div class="prom_slide_next" onclick="promSlider.nextSlide(); promSlider.pauseSlideShow();" href="javascript:void(0);"></div>             
        <div class="prom_slide_previous" onclick="promSlider.previousSlide(); promSlider.pauseSlideShow();" href="javascript:void(0);"></div>
        <div class="prom_slide_link_container" id="prom_slide_link_container"></div>
    </div>
    <script lang="javascript" type="text/javascript">
        var promSlider = new SlidePanel('prom_slidePanel','promSlider');        
        promSlider.addImgSrc('http://www.hornavanhotell.se/upload/bilder/toppbilder/skoter.jpg');
        promSlider.addImgSrc('http://www.miyazaki-city.tourism.or.jp/images/spot/sp17/main.jpg');
        promSlider.addImgSrc('http://www.arkadelphiaalliance.com/media/images/ContactHeader.jpg');
        promSlider.addImgSrc('http://www.arkadelphiaalliance.com/media/uploads/page_banner_images/tourismHdr.jpg');
        promSlider.addImgSrc('http://virtualvallarta.com/puertovallarta/bm.pix/a-168.jpg');
        
        promSlider.setClassPrefix('prom');
        promSlider.setShowInterval(5000);
        promSlider.setPauseInterval(20000);
        promSlider.begin();       
       
        var colorPicker = new ColorPicker();
    </script>
</div>

