<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Gallery</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Gallery</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<style>
  .delete-button {
    display: inline-block;
    padding: 5px 10px;
    background-color: red;
    color: white;
    text-decoration: none;
  }

  .drop-area {
    width: 100%;
    height: 200px;
    border: 2px dashed #ccc;
    border-radius: 5px;
    text-align: center;
    font-size: 20px;
    padding: 10px;
    margin-bottom: 20px;
  }

  .image-preview-container {
    display: flex;
    flex-wrap: wrap;
  }

  .image-preview {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 100px;
    border: 1px solid #ccc;
    margin: 10px;
  }

  .image-preview img {
    width: 100%;
    height: 100%;
  }

  .delete-button {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #fff;
    color: #f00;
    font-size: 12px;
    border: none;
    cursor: pointer;
  }
</style>
<script>
  function allowDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    event.dataTransfer.dropEffect = 'copy';
  }

  function handleDrop(event) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    handleFiles(files);
  }
</script>
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4 class="card-title">Facilities</h4>
          </div>
          <div class="card-body">
            <div class="row gap-4">
              <?php
              $sqlgallery = mysqli_query($con, "SELECT * from gallery_image");
              while ($result = mysqli_fetch_assoc($sqlgallery)) {
              ?>
                <div class="col-sm-2 ">
                  <a href="/admin/ref/<?php echo $result['gallery_image'] ?>" data-toggle="lightbox" data-gallery="gallery">
                    <img src="/admin/ref/<?php echo $result['gallery_image'] ?>" style="height:100px; width:150px;" class="img-fluid mb-2 image_num" alt="white sample" />
                  </a>
                  <button image="<?php echo $result['id']; ?>" class="btn btn-danger btnDeleteGalleryImg"><i>Delete</i></button>
                </div>
              <?php } ?>
            </div>
          </div>

        </div>
        <div class="drop-area" ondrop="handleDrop(event)" ondragover="allowDrop(event)">
          Drag and drop images here <br>
         <input style="margin-top:50px;"type="file" name="images[]" multiple onchange="handleFiles(this.files)">

        </div>
        <h2>Image Previews:</h2>
        <div id="image-previews" data-toggle="preview" data-gallery="gallery"style="background:#ccc;"></div><br>
        <form action="uploadimage-process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <input type="submit" class="btn btn-success btnUploadGalleryImg" image=".image_num" value="Upload">
        </form>
        <script>
          function validateForm() {
            var fileInput = document.querySelector('input[type="file"]');
            if (fileInput.files.length === 0) {
              alert("Please select at least one file.");
              return false;
            }
            return true;
          }
        </script>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<script>
  function handleFiles(files) {
  var imageCount = 0; // Initialize image count

  for (var i = 0; i < files.length; i++) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var imagePreview = document.createElement("div");
      imagePreview.id = "uploadparent";
      imagePreview.className = "image-preview";
      imagePreview.innerHTML = '<img class="child-div" src="' + e.target.result + '" alt="Image">';

      var deleteButton = document.createElement("button");
      deleteButton.className = "btn btn-danger btn-sm";
      deleteButton.innerHTML = "Delete";
      deleteButton.addEventListener("click", function() {
        deleteImagePreview(imagePreview);
        imageCount--; // Decrease image count when an image is deleted
      });

      imagePreview.appendChild(deleteButton);

      document.getElementById("image-previews").appendChild(imagePreview);

      imageCount++; // Increase image count when a new image is added
      console.log("Image count: " + imageCount);
    };

    reader.readAsDataURL(files[i]);
  }
}

  function deleteImagePreview(imagePreview) {
    imagePreview.remove();
  }

  
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>