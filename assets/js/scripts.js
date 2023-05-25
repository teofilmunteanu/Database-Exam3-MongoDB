
function showUploadMenuLocal()
{
    document.getElementById("uploadCover").style.display='block';
    document.getElementById("boxLocal").style.display = 'block';
}

function hideUploadMenuLocal()
{
    document.getElementById("uploadCover").style.display = 'none';
    document.getElementById("boxLocal").style.display = 'none';
}

function showUploadMenuPublic()
{
    document.getElementById("uploadCover").style.display='block';
    document.getElementById("boxPublic").style.display = 'block';
}

function hideUploadMenuPublic()
{
    document.getElementById("uploadCover").style.display = 'none';
    document.getElementById("boxPublic").style.display = 'none';
}



var idToDelete="";

function selectDelete(id){
    idToDelete = id;
}

function confirmDelete(){
    window.location.href = "delete.php?id="+idToDelete;
}

