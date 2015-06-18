function deletePost(){
    var result = confirm('Are you sure you want to delete this image?');
    if (result) {
        return true;
    }else{
        return false;
    }
}