var loadFile = function(event) {
	var previewImage = document.getElementById('preview');
	previewImage.src = URL.createObjectURL(event.target.files[0]);
};