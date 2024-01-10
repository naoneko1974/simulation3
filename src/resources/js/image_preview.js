$('#image').on('change', function () {
  const fr = new FileReader();
  const fn = $(this).prop('files')[0];
  fr.onload = function (ev) {
    $('#preview').attr('src', ev.target.result);
  }
  $('#file_name').text(fn.name);
  fr.readAsDataURL(this.files[0]);
});
