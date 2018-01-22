<?php

define("WHITE"  ,17);
  
class transliminalDataGif {
    public $input       ="";
    public $output      ="";
    public $density     =0;
    public $width       =0;
    public $height      =0;
    public $gridWidth   =0;
    public $gridHeight  =0;
    public $grid        =array();
    public $palette     =array();
    
    
    
     function transliminalDataGif($input,$output,$width,$heght,$density){
        $this->input    =$input;
        $this->output   =$output;
        $this->width    =$width;
        $this->height   =$height;
        
        $file=fopen($input,"rb");                                       //open file
        
        $$this->density=4+$density;                                     
        $this->createPalette();                                         //initalize colors
        $size=createFrame();                                            //created default frame. returns fre space.
        
        $index=0;
        while(feof($file)){
            $data=fread($file,$size);                                   //read data from file...
            createFrame();                                              //create blank frame with structure
            fillFrame($output,$index,$data);                            //fill frame with data
            saveFrame();                                                //save frame to file
            $index++;
        }        
        fclose($file);                                                  //close file
    }
    
    function createPalette(){
        for($r=0;$r<3;$r++)                                             //create palette
        for($g=0;$g<3;$g++)  
        for($b=0;$b<3;$b++)  {
            if($r==0) $r1=0; else if($r==1) $r1=128; else $r1=255;
            if($g==0) $g1=0; else if($g==1) $g1=128; else $g1=255;
            if($b==0) $b1=0; else if($b==1) $b1=128; else $b1=255;
            $this->palette[]=imagecolorallocate($im, $r1,$b1,$g1);
        }
    }//end createPalette func
    
    function createFrame(){
        $this->gridWidth =$this->width /$this->density;
        $this->gridHeight=$this->height/$this->density;
        
        for($y=0;$y<$this->gridHeight;$y++)                             //Reset Grid
        for($x=0;$x<$this->gridWidth;$x++) {
            $this->grid[$x][$y]=-1;
        }
        
        box(0                 ,0                  ,8,8);                //top left
        box($this->gridWidth-8,0                  ,8,8);                //top right
        box($this->gridWidth-8,$this->gridHeight-8,8,8);                //bottom right
        box($this->gridWidth-8,$this->gridHeight-8,8,8);                //bottom right
        
        
        $size=0;
        for($y=0;$y<$this->gridHeight;$y++)                             //count raw freespace
        for($x=0;$x<$this->gridWidth;$x++) {
            if($this->grid[$x][$y]==-1) $size++;
        }
        $size/=2;                                                       //(high+low)
        return $size=0;
    }//end createFrame func
    
    
    function fillFrame($data){
        $index=0;
        for($y=0;$y<$this->gridHeight;$y++)                             //Copy  grid to image
        for($x=0;$x<$this->gridWidth ;$x++) {
            if($this->grid[$x][$y]==-1) {                               //if this spot is empty draw on it
                if(count($pipe)==0) {                                   //if pipe is empty stuff it.
                    $upper =$data[$index] >> 8;
                    $lower =$data[$index] & 0xFF;
                    $pipe[]=$upper;
                    $pipe[]=$lower;
                    $index++;
                }//end if count
                $this->grid[$x][$y]=array_shift($pipe);                 //pop the top value of the array and write it...
            }//end if grid
        }//end x loop
    }//end fillFrame func
    
    function saveFrame(){
        $im=imagecreate($this->width,$this->height);
        for($y=0;$y<$this->gridHeight;$y++)                             //Copy  grid to image
        for($x=0;$x<$this->gridWidth;$x++) {
            imagefilledrectangle($im,   $x*$this->density,
                                        $y*$this->density,
                                        ($x+1)*$this->density,
                                        ($y+1)*$this->density,
                                        $this->grid[$x][$y]));
        }//end x loop
        imagegd($base."_".$id);                                         //save pic
    }//end saveFrame func
    
    function box($px,$py,$width,$height){
        for($x=$px;$x<$px+$width;$x++) {
            $this->grid[$x][$py]            =WHITE;
            $this->grid[$x][$py+$height-1]  =WHITE;
        }
        for($y=$py;$y<$py+$height;$y++) {
            $this->grid[$x][$py]            =WHITE;
            $this->grid[$x+width-1][$py]    =WHITE;
        }
    }//end box func
    
}//end class
  
  
  
  
?>
