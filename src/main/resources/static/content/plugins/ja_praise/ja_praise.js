$(document).on('click', '.ja_praise', function(){
	var a = $(this),
	id = a.data('ja_praise');
	if(ja_praise_check(id)){
		alert('您已赞过本文！');
	}else{
		$.post('',{plugin: 'ja_praise', action: 'praise', id: id}, function(b){
			a.find('span').html(b);
			ja_praise_(a);
		});
	}
});

function ja_praise_check(id){
	return new RegExp('ja_praise_' + id +'=true').test(document.cookie);
}

$('[data-ja_praise]').each(function(){
	var a = $(this),
	id = a.data('ja_praise');
	if(ja_praise_check(id)){
		ja_praise_(a);
	}else{
		a.attr('title','喜欢就赞一下吧！')
	}
});

function ja_praise_(a){
	a.css('cursor', 'not-allowed').attr('title','您已赞过本文！');
}