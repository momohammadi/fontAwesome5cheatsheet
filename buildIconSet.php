<?
/* 
 * Class Name: buildIconSet
 * Description: this php class help to Receive,Update font list from fontawesome.com version 5.X easy to use on your project
 * Version: 1
 * Author URI: https://github.com/momohammadi/
 * GitHub Plugin URI: https://github.com/momohammadi/fontAwesome5cheatsheet
 * GitHub Branch: master
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/
class buildIconSet{
    protected $content;
    protected $pageContent;
    public function __construct(){
        $url = 'https://fontawesome.com/cheatsheet';
        $this->content = file_get_contents($url);
    }
    //for update fontlist of fontawsome 
    /*
    $build = new buildIconSet();
    $build->fontawsome5_cheatsheet();    
    */
    public function fontawsome5_cheatsheet(){        
        $pageContent = '<section id="icons">
      <h2 class="page-header">Font Awesome Icons</h2>
      <div class="container">
      <table class="table table-bordered">
        <tbody>';
        preg_match_all('/__ = (.*)/',$this->content,$content);
        $content = $content[1][0];
        $data = json_decode($content,true)[2]['data'];
        $j = 0;
        foreach($data as $key => $value){
            if(!empty($value['attributes']['membership']['free'])){           
                $className  = $value['attributes']['id'];
                $faClass = $value['attributes']['membership']['free'];
                foreach($faClass as $k => $v){
                    if($v=='solid'){
                        $fa = 'fas';                        
                    }elseif($v=='regular'){
                        $fa = 'far';
                    }else{
                        $fa = 'fab';
                    }
                    if($j==0){
                        $pageContent .="<tr>";
                    }                
                    $j++;                     
                    $pageContent .=PHP_EOL.'<td style="text-align:center;"><a href="#"><i style="font-size:30px;" class="'.$fa.' fa-'.$className.'" aria-hidden="true"></i></br>'.$className.'</a></td>'.PHP_EOL;
                    if(6-$j==0){
                        $pageContent .="</tr>";
                        $j=0;
                    }                    
                }                
            } 
        }
        $pageContent .='</table></tbody></div></section>';
        
        //save output in the file
        $file=fopen(__DIR__.'iconSets.html','w');
        fwrite($file,$pageContent);
        fclose($file);
    }
} 
