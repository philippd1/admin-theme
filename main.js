function setTheme(themeurl) {
	document.getElementById('themeurl').value = themeurl;
	document.getElementsByName('save')[0].click();
}
$(function() {
	$.get(`https://bootswatch.com/api/4.json`, function(data) {
		console.log(data);
		data.themes.forEach((theme) => {
			$('#bootswatch_themes').append(`
            <div class="card col-4">
  <img class="card-img-top" src="${theme.thumbnail}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">${theme.name}</h5>
    <p class="card-text">${theme.description}</p>
    <span name="themeurl" onclick="setTheme('${theme.cssCdn}')" class="btn btn-primary btn-block" href="${theme.cssCdn}">use theme</span>
  </div>
</div>
            `);
		});
	});
	autosize(document.querySelector('textarea'));
});
