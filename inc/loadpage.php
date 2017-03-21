<div class="w3-container w3-dark-grey w3-card-4">
	<a href="index.php"><h1 class="w3-center w3-xxlarge">Image-Slicer</h1></a>
</div>

<div class="w3-card-4 w3-grey w3-padding w3-round-large" style="margin:10% 10%">
    <h1 class="w3-center w3-xxxlarge w3-text-white">Hello!</h1>
    <p class="w3-center w3-text-white">We Ready to Cut your Shitty pictures.</p>
</div>
  
 <form enctype="multipart/form-data" class="w3-center w3-card-4 w3-light-grey w3-margin w3-padding w3-round-large" method="post" action="">
        <label for="exampleInputFile" class="w3-label w3-text-black">Just load some pics and mark up it.</label>
        <input type="file"  name="images[]" id="exampleInputFile" aria-describedby="fileHelp" multiple="true">
        <input type="submit" class="w3-btn w3-large w3-center w3-ripple w3-round w3-green" value="Load It" name="submit">
</form>