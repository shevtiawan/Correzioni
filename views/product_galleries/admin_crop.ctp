
<?php
  echo $this->Html->css(array('imgareaselect-default'));
  echo $this->Javascript->link(array('jquery.min','jquery.imgareaselect.pack'));
?>

<script type="text/javascript">
function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;
    
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * 300),
        height: Math.round(scaleY * 300),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });

    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);    
}

$(function () {
    $('#photo').imgAreaSelect({ aspectRatio: '1:1', handles: true,
        fadeSpeed: 200, onSelectChange: preview });
});
</script>


<div class="container demo" style="width:750px;height:400px;background:#EEEEFF;">
 <div style="float: left; width: 45%;">
  <p class="instructions">
   Click and drag on the image to select an area. 
  </p>
 
  <div style="margin: 0pt 0.3em; width: 300px; height: 300px;" class="frame">
   <?php
             echo $this->Html->image($photo['ProductGallery']['image_dir']."/medium_".$photo['ProductGallery']['image'], 
                                                 array('id'=>"photo",'style'=>'width: 300px; height: 300px;'));
    ?>
  </div>
 </div>
 
 <div style="float: left; width: 30%;">
  <p style="font-size: 110%; font-weight: bold; padding-left: 0.1em;">
   Selection Preview
  </p>
  
  <div style="margin: 0pt 1em; width: 100px; height: 100px;" class="frame">
   <div style="width: 100px; height: 100px; overflow: hidden;" id="preview">
    <?php
              echo $this->Html->image($photo['ProductGallery']['image_dir']."/thumbnail_".$photo['ProductGallery']['image'], array('style'=>'width: 100px; height: 100px;'));
    ?>
   </div>
  </div>


  <table style="margin-top: 1em;">
   <thead>
    <tr>
     <th style="font-size: 110%; font-weight: bold; text-align: left; padding-left: 0.1em;" colspan="2">
      Coordinates
     </th>
     <th style="font-size: 110%; font-weight: bold; text-align: left; padding-left: 0.1em;" colspan="2">
      Dimensions
     </th>
    </tr>
   </thead>
   <tbody>
    <tr>
     <td style="width: 10%;"><b>X<sub>1</sub>:</b></td>
     <td style="width: 30%;"><input type="text" value="-" id="x1"></td>
     <td style="width: 20%;"><b>Width:</b></td>
     <td><input type="text" id="w" value="-"></td>
    </tr>
    <tr>
     <td><b>Y<sub>1</sub>:</b></td>
     <td><input type="text" value="-" id="y1"></td>
     <td><b>Height:</b></td>
     <td><input type="text" value="-" id="h"></td>
    </tr>
    <tr>
     <td><b>X<sub>2</sub>:</b></td>
     <td><input type="text" value="-" id="x2"></td>
     <td></td>
     <td></td>
    </tr>
    <tr>
     <td><b>Y<sub>2</sub>:</b></td>
     <td><input type="text" value="-" id="y2"></td>
     <td></td>
     <td></td>
    </tr>
   </tbody>
  </table>
    
 </div>
</div>