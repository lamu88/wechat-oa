$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).find(' > i').addClass('fa fa-plus-circle myicon').removeClass('fa fa-minus-circle myicon');
        } else {
            children.show('fast');
            $(this).find(' > i').addClass('fa fa-minus-circle myicon').removeClass('fa fa-plus-circle myicon');
        }
        e.stopPropagation();
    });
});