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
		������������ ���������� �������
	*/

jQuery("#addSelect").click(
function()
{
	var addedSelect =	'<select id="add-select" name="add-select">'+
						'<option value="1">������ ���</option>'+
						'<option value="2">������ ���������</option>'+
						'<option value="3">������ ��������������</option>'+
						'<option value="4">���� ��������</option>'+
						'<option value="5">������</option>'+
						'<option value="6">�����</option>'+
						'<option value="7">����</option>'+
						'</select>';
	jQuery(this).replaceWith(addedSelect);
	
	var params = {
		changedEl: ".lineForm select",
		visRows: 4
	}
	cuSel(params);
	
});

/*
	����� �������� �������
 */
jQuery("#showSel").click(
function()
{
	jQuery(this).prev().fadeIn();
	params = {
	refreshEl: "#city2, #city20, #city30", /* ����������� ����� ������� id ��������, ������� ����� �������� */
	visRows: 4
	}
	cuSelRefresh(params);

});

/*
	������������ ���������� ��������
*/
jQuery("#addAnimals").click(
function()
{
	var newAnimals = '<span val="4">����</span><span val="5">����� �����������</span>';
	
	jQuery("#cusel-scroll-animals").append(newAnimals);
	
	/* ��������� ������, ����� ������������������� �������� */
		
	
	var params = {
		refreshEl: "#animals",
		visRows: 4
	}
	cuSelRefresh(params);
	
});
jQuery("#butTest").click(
function()
{
	if(jQuery(this).val()=="������������ ������") 
	{
		jQuery("#cuselFrame-amimals3").addClass("classDisCusel");
		jQuery(this).val("������������� ������");
	}
	else
	{
		jQuery("#cuselFrame-amimals3").removeClass("classDisCusel");
		jQuery(this).val("������������ ������");
	}
});


});