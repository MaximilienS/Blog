$(document).ready(function(){
	// Si la page est intégralement chargée, j'execute le code ci_dessous
	$('#stars').raty({
		path: 'vues/lib/images',
		scoreName : 'note'
	});
});