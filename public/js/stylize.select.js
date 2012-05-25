jQuery(document).ready(function(){

var params = {
		changedEl: ".lineForm select",
		visRows: 5,
		scrollArrows: true
	}

	cuSel(params);
	
	var params = {
		changedEl: "#city",
		scrollArrows: false
	}

	cuSel(params);
	
	
	/*
		динамическое добавление селекта
	*/

jQuery("#addSelect").click(
function()
{
	var addedSelect =	'<select id="add-select" name="add-select">'+
						'<option value="1">доллар США</option>'+
						'<option value="2">доллар канадский</option>'+
						'<option value="3">доллар новозеландский</option>'+
						'<option value="4">фунт стерлинг</option>'+
						'<option value="5">гривна</option>'+
						'<option value="6">рубль</option>'+
						'<option value="7">евро</option>'+
						'</select>';
	jQuery(this).replaceWith(addedSelect);
	
	var params = {
		changedEl: ".lineForm select",
		visRows: 4
	}
	cuSel(params);
	
});

/*
	показ скрытого селекта
 */
jQuery("#showSel").click(
function()
{
	jQuery(this).prev().fadeIn();
	params = {
	refreshEl: "#city2, #city20, #city30", /* перечисляем через запятую id селектов, которые нужно обновить */
	visRows: 4
	}
	cuSelRefresh(params);

});

/*
	динамическое добавление оптионов
*/
jQuery("#addAnimals").click(
function()
{
	var newAnimals = '<span val="4">Слон</span><span val="5">Жираф африканский</span>';
	
	jQuery("#cusel-scroll-animals").append(newAnimals);
	
	/* обновлеям селект, чтобы перинициализировать сроллинг */
		
	
	var params = {
		refreshEl: "#animals",
		visRows: 4
	}
	cuSelRefresh(params);
	
});
jQuery("#butTest").click(
function()
{
	if(jQuery(this).val()=="Задизайблить селект") 
	{
		jQuery("#cuselFrame-amimals3").addClass("classDisCusel");
		jQuery(this).val("Раздизайблить селект");
	}
	else
	{
		jQuery("#cuselFrame-amimals3").removeClass("classDisCusel");
		jQuery(this).val("Задизайблить селект");
	}
});


});