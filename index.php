<?php
// Load saved content
$content = json_decode(file_get_contents('content.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Editable Site Demo</title>
<style>
  body { font-family: Arial, sans-serif; margin: 40px; }
  img { max-width: 300px; display: block; margin-bottom: 20px; }
  .editable { border: 1px dashed #ccc; padding: 5px; }
  #saveBtn { padding: 10px 20px; font-size: 16px; }
</style>
</head>
<body>

<h1 class="editable" contenteditable="true"><?php echo $content['title']; ?></h1>
<p class="editable" contenteditable="true"><?php echo $content['paragraph']; ?></p>

<img id="image" src="<?php echo $content['image']; ?>" alt="Editable Image">
<input type="file" id="imageInput">

<br><br>
<button id="saveBtn">Save Changes</button>

<script>
// Handle image preview
document.getElementById('imageInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(ev){
            document.getElementById('image').src = ev.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Save changes
document.getElementById('saveBtn').addEventListener('click', function(){
    const title = document.querySelector('h1').innerText;
    const paragraph = document.querySelector('p').innerText;
    const imageSrc = document.getElementById('image').src;

    fetch('save.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({title, paragraph, image: imageSrc})
    }).then(res => res.text())
      .then(msg => alert(msg));
});
</script>

</body>
</html>
