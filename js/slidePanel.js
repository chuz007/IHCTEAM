function SlidePanel (idPanel,name)
{
    this.idPanel=idPanel;    
    this.currentSlide = 0;
    this.currentImage = 0;
    this.imgSources = new Array(); 
    this.slideShowInterval = 0;    
    this.classPrefix = "";
    this.name = name;
    this.timer = null;
    this.pause = false;
    this.pauseInterval = 0;
    this.begin = function()
    {
         $('#' + idPanel + '_slide_image0').attr("src", this.imgSources[0]);
         $('#' + idPanel + '_slide0').fadeIn('slow');         
         this.createSlideLinks();
         if(this.slideShowInterval > 0)
         {
            this.timer = setTimeout(this.name + '.slideShowBegin("'+ this.name + '")', this.slideShowInterval);
         }         
    };
    
    this.createSlideLinks = function()
    {
        var html = '';
        for (i = 0; i < this.imgSources.length; i++) {
            var current = '';
            if(i==this.currentSlide)
            {
                current = '_current';
            }
            var classNId = this.classPrefix + '_slide_link';
            html += '<div id="' + classNId + i + '" class="' + classNId + current +'" onclick="' + this.name + '.toSlide(' + i + '); ' + this.name + '.pauseSlideShow();"></div>';
        } 
        $('#' + this.classPrefix + '_slide_link_container').html(html);
    };
    
    this.fixSlideLink = function()
    {
        for (i = 0; i < this.imgSources.length; i++) {
            var current = '';
            if(i==this.currentImage)
            {
                current = '_current';
            }
            var classNId = this.classPrefix + '_slide_link' + current;
            $('#'+this.classPrefix + '_slide_link' + i).attr('class',classNId);
        }        
    };
    
    this.fixTimer = function()
    {
      if(this.slideShowInterval > 0 && !this.pause)
      {
          window.clearTimeout(this.timer);
          this.timer = window.setTimeout(this.name + '.slideShowBegin("' + this.name + '")', this.slideShowInterval); 
      }  
    };
    
    this.setClassPrefix = function(classPrefix)
    {
        this.classPrefix = classPrefix;
    };
    
    this.setShowInterval = function(interval)
    {
        this.slideShowInterval = interval;
    };
    
    this.setPauseInterval = function(interval)
    {
        this.pauseInterval = interval;
    }
    
    this.slideShowBegin = function()
    {
       this.nextSlide();
    };   
    
    this.nextSlide = function()
    {        
        var tempSlide = this.currentSlide;
        if(this.currentSlide == 1)
        {
            this.currentSlide = 0;
        }else
        {
            this.currentSlide++;
        }
        if(this.currentImage == (this.imgSources.length - 1))
        {
            this.currentImage = 0;
        }else
        {
            this.currentImage++;
        }
        $('#' + idPanel + '_slide_image' + this.currentSlide).attr("src", this.imgSources[this.currentImage]); 
        $('#' + idPanel + '_slide'+ tempSlide).fadeOut('slow');
        $('#' + idPanel + '_slide'+ this.currentSlide).fadeIn('slow',this.fix());
        
    };
    
    this.fix = function()
    {
        this.fixSlideLink(); 
        this.fixTimer();
    };
    
    this.pauseSlideShow = function()
    {
        this.pause = true;
        window.clearTimeout(this.timer);
        if(this.pauseInterval > 0){
            this.timer = setTimeout(this.name + '.continueSlideShow()', this.pauseInterval);
        }
        
    };
    this.continueSlideShow = function()
    {
        this.pause = false;
        this.slideShowBegin();
    };
    this.previousSlide = function()
    {   
        var tempSlide = this.currentSlide;        
        if(this.currentSlide == 0)
        {
            this.currentSlide = 1;
        }else
        {
            this.currentSlide--;
        }
        if(this.currentImage == 0)
        {
            this.currentImage = (this.imgSources.length - 1);
        }else
        {
            this.currentImage--;
        }
        $('#' + idPanel + '_slide_image' + this.currentSlide).attr("src", this.imgSources[this.currentImage]);        
        $('#' + idPanel + '_slide'+ tempSlide).fadeOut('slow');
        $('#' + idPanel + '_slide'+ this.currentSlide).fadeIn('slow',this.fix());        
    };
    
    this.toSlide = function(imageNumber)
    {var tempSlide = this.currentSlide;        
        if(this.currentSlide == 0)
        {
            this.currentSlide = 1;
        }else
        {
            this.currentSlide--;
        }        
        this.currentImage = imageNumber;        
        $('#' + idPanel + '_slide_image' + this.currentSlide).attr("src", this.imgSources[imageNumber]);
        $('#' + idPanel + '_slide'+ [tempSlide]).fadeOut('slow');        
        $('#' + idPanel + '_slide' + this.currentSlide).fadeIn('slow',this.fix());                
    };
    
    this.addImgSrc = function(src)
    {
        this.imgSources[this.imgSources.length] = src;
    };
}
