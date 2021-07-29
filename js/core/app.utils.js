var utils = {
    setupPagination: function (pages, currentPage, target) {
        var paginas = '<li class="page-item">' +
            '<a class="page-link" href="javascript:;" data-changepage="'+(currentPage == 1 ? 1 : (currentPage - 1))+'" aria-label="Previous">' +
            '<span aria-hidden="true">&laquo;</span>' +
            '</a>' +
            '</li>';
        for (var i = 0; i < pages; i++) {
            var classeAdd = '';
            if ((i + 1) == currentPage)
                classeAdd = 'active';

            paginas += '<li class="page-item ' + classeAdd + '"><a class="page-link" href="javascript:;" data-changepage="'+(i + 1)+'">' + (i + 1) + '</a></li>'

        }
        paginas += '<li class="page-item">' +
            '<a class="page-link" href="javascript:;" aria-label="Next" data-changepage="'+(currentPage == pages ? pages : (currentPage + 1))+'">' +
            '<span aria-hidden="true">&raquo;</span>' +
            '</a>' +
            '</li>';

        $( target ).html(paginas);
    }
};