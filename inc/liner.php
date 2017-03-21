<!-- Содержание страницы -->
<div class="w3-container w3-dark-grey w3-card-4">
    <a href="index.php"><h1 class="w3-center w3-xxlarge">
    <i class="fa fa-angle-left" aria-hidden="true"></i> back to Image loader</h1></a>
</div>

<div class="w3-card-4 w3-grey w3-padding w3-round-large" style="margin:10% 10%">
  <h1 class="w3-center w3-xxlarge w3-text-white">
  <i class="fa fa-file-image-o" aria-hidden="true"></i> Your Files:</h1>

  <ul class="w3-ul">
      <?php
        $files = scandir("Upload");
        $count = 0;
        foreach($files as $file){
          if(substr($file, 0, 1) != "." ){
          echo '<li class="w3-panel 
                  w3-light-grey 
                  w3-btn 
                  w3-block"
                  data = "Upload/'.$file.'" idToProcess = "',$count.'">';  
          echo $file;          
          echo "</li>\n";
          $count++;
          } 
        }
      ?>
  </ul>

  <form method="post" action="">
      <input type="submit" class="w3-btn w3-large w3-center w3-ripple w3-round w3-green" value="Process It" id="processIt" disabled>
      <input type="hidden" value="" id="data" name="process">
  </form>
</div>


  
<!-- Модальное Окно -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-card-8 w3-animate-zoom " style="max-width:600px">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal" style="z-index:1;">&times;</span>
        <br>
    <div style="width:90%; margin:0 auto;position:relative;" id="image">
            <img  src="#" 
                  alt="Avatar" 
                  style="-webkit-user-select: none;width:100%"
                  ondrag="return false" 
                  ondragdrop="return false" 
                  ondragstart="return false">
    </div>

    <form class="w3-container">
            <div class="w3-section">
                <div class="w3-row">
                  <div class="w3-third">
                  	<label><b>rows</b></label>
                    <input class="w3-input 
                    	w3-border" 
                        type="number" 
                        value=1 
                        name="rows" 
                        style="width:50px" id="row">
                  </div>
                  <div class="w3-third">
                  	<label><b>cols</b></label>
                    <input class="w3-input 
                    	w3-border" 
                        type="number" 
                        value=1 
                        name="rows" 
                        style="width:50px"
                        id="col">
                  </div>
                  <div class="w3-third ">
                  	<button type="button" class="w3-button w3-teal w3-margin-top" id="makeAsPattern">
                        Make As Pattern
                    </button>
                  </div>
                </div>
            </div>
    </form>

    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-center">
      <button type="button" class="w3-button w3-red" id="saveCurMarkup">
        Save
      </button>
    </div>

  </div>
</div>
  
<div class="w3-container w3-dark-grey w3-card-4 w3-padding w3-bottom w3-center">  
  <button id="show" class="w3-btn w3-amber w3-ripple w3-round-xlarge">showArray</button>
  <button id="show2" class="w3-btn w3-amber w3-ripple w3-round-xlarge">datashow</button>
</div>  
  
<script src="assets/js/app.js"></script>  